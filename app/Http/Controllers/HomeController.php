<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{

    public function index()
    {

        $notification = Db::select('select * from notification_table limit 1');

        session()->put('notification', $notification[0]->notification_desc);

        $result = Db::select('SELECT * FROM dollar_charges');
        session()->put('dollarrate', $result[0]->dollar_charge_amount);

        $data = Db::select('SELECT *,plan.status as pstatus from plan INNER join plan_category on plan.cat_id = plan_category.cat_id limit 3');

        return view('frontend.index', compact('data'));
    }
    public function about()
    {

        $notification = Db::select('select * from notification_table limit 1');

        session()->put('notification', $notification[0]->notification_desc);

        return view('frontend.about');
    }
    public function plans()
    {


        $notification = Db::select('select * from notification_table limit 1');

        session()->put('notification', $notification[0]->notification_desc);


        $data = Db::select('SELECT *,plan.status as pstatus from plan INNER join plan_category on plan.cat_id = plan_category.cat_id');

        $result = Db::select('select * from invest inner join plan on invest.plan_id = plan.plan_id inner join user on invest.user_id = user.user_id
        where plan.status = 1 and user.user_id = ?', [session()->get('id')]);


        return view('frontend.plans', compact('data'));
    }
    public function contact()
    {

        $notification = Db::select('select * from notification_table limit 1');

        session()->put('notification', $notification[0]->notification_desc);


        return view('frontend.contact');
    }

    function contactstore(Request $req){
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'text' => 'required',
            'message' => 'required'
        ]);

    }

    public function login()
    {

        $notification = Db::select('select * from notification_table limit 1');

        session()->put('notification', $notification[0]->notification_desc);


        if (session()->has('email')) {
            return redirect('/');
        }

        return view('frontend.login');
    }

    public function loginstore(Request $req)
    {
        $req->validate([
            'email' => 'required | max: 50',
            'password' => 'required | max: 50',
        ]);

        $result = Db::select(
            'select * from user where user_email = ? and user_password = ? ',
            [$req->email, $req->password]
        );

        if (!$result) {

            session()->flash('status', 'Login Failed! Email and Password is In Correct');


            return redirect('/login');
        }
        if ($result) {

            if ($result[0]->status == 0 || $result[0]->delstatus == 1) {

                session()->flash('status', 'Login Failed! Your Account is Inactive');
                return redirect('/login');
            } else {

                session()->flash('statusl', '1');

                session()->put('id', $result[0]->user_id);
                session()->put('name', $result[0]->user_name);
                session()->put('email', $result[0]->user_email);
                session()->put('role', $result[0]->role);

                if (session()->get('role') == 3) {
                    return redirect('/dashboard');
                }
            }

            return redirect('/');
        }
    }

    public function invest($id)
    {

        $notification = Db::select('select * from notification_table limit 1');

        session()->put('notification', $notification[0]->notification_desc);


        $data = Db::select('select * from plan where plan_id = ?', [$id]);
        return view('frontend.invest', compact('data'));
    }

    public function investstore(Request $req, $id)
    {
        $req->validate([
            'amount' => 'required'
        ]);

        $rsult = Db::select('select * from plan where plan_id = ?', [$id]);
        if ($rsult) {

            $deposit = Db::select('SELECT sum(transaction.amount) as depositamount from transaction, deposit INNER JOIN user on deposit.user_id = user.user_id where
                deposit.deposit_id  = transaction.transaction_id and deposit.user_id = ? and transaction.status = 1 and transaction.type = 0', [session()->get('id')]);

            $invest = Db::select('SELECT sum(transaction.amount) as investamount from transaction, invest
                INNER JOIN user on
                invest.user_id = user.user_id where invest.invest_id  = transaction.transaction_id and
                 invest.user_id = ? and transaction.status = 1 and transaction.type = 2', [session()->get('id')]);

            $balance = $deposit[0]->depositamount - $invest[0]->investamount;

            if ($balance >= $req->amount) {

                $data = Db::select('select * from plan where plan_id = ?', [$id]);

                if ($req->amount >= $data[0]->minimum_amount && $req->amount <= $data[0]->maximum_amount) {
                    $a = $data[0]->duration_number;
                    $b = $data[0]->duration_type;

                    $result1 = Db::insert(
                        "insert into invest(plan_id,user_id,amount,status,end_date) values(?,?,?,?,date_add(CURRENT_TIMESTAMP(),interval $a day))",
                        [$id, session()->get('id'), $req->amount, 1]
                    );

                    if ($result1) {

                        $data = Db::select('select * from invest order by invest_id desc limit 1');

                        Db::insert(
                            'insert into transaction(type,transaction_id,user_id,amount,status) values(?,?,?,?,?)',
                            [2, $data[0]->invest_id, session()->get('id'), $req->amount, 1]
                        );

                        $user = Db::select('select * from user where user_id = ?',[session()->get('id')]);

                        $l1  = Db::select('select * from user where user_id  = ?',[$user[0]->parent_id]);

                        $com = Db::select('select * from teamcomission where level = 1');

                        $per = $req->amount/100;
                        $per = $per * $com[0]->comission_per;

                        if($l1){
                            DB::insert('insert into comission(invest_id,user_id,from_user,amount) values(?,?,?,?)',
                            [$data[0]->invest_id,$l1[0]->user_id,session()->get('id'),$per]);

                            $dd = Db::select('select * from comission order by comissionid desc limit 1');

                            Db::insert('insert into transaction(type,transaction_id,user_id,amount,status)
                            values(?,?,?,?,?)',[4,$dd[0]->comissionid,$l1[0]->user_id,$per,1]);
                            $l2  = Db::select('select * from user where user_id  = ?',[$l1[0]->parent_id]);

                            if($l2){
                                $com = Db::select('select * from teamcomission where level = 2');

                                $per = $req->amount/100;
                                $per = $per * $com[0]->comission_per;

                                DB::insert('insert into comission(invest_id,user_id,from_user,amount) values(?,?,?,?)',
                                [$data[0]->invest_id,$l2[0]->user_id,session()->get('id'),$per]);

                                $dd = Db::select('select * from comission order by comissionid desc limit 1');

                                Db::insert('insert into transaction(type,transaction_id,user_id,amount,status)
                                values(?,?,?,?,?)',[4,$dd[0]->comissionid,$l2[0]->user_id,$per,1]);

                                $l3  = Db::select('select * from user where user_id  = ?',[$l2[0]->parent_id]);
                            }
                            if($l3){
                                $com = Db::select('select * from teamcomission where level = 3');

                                $per = $req->amount/100;
                                $per = $per * $com[0]->comission_per;

                                DB::insert('insert into comission(invest_id,user_id,from_user,amount) values(?,?,?,?)',
                                [$data[0]->invest_id,$l3[0]->user_id,session()->get('id'),$per]);
                                $dd = Db::select('select * from comission order by comissionid desc limit 1');

                                Db::insert('insert into transaction(type,transaction_id,user_id,amount,status)
                                values(?,?,?,?,?)',[4,$dd[0]->comissionid,$l3[0]->user_id,$per,1]);

                                $l4  = Db::select('select * from user where user_id  = ?',[$l3[0]->parent_id]);
                            }
                            if($l4){
                                $com = Db::select('select * from teamcomission where level = 4');

                                $per = $req->amount/100;
                                $per = $per * $com[0]->comission_per;

                                DB::insert('insert into comission(invest_id,user_id,from_user,amount) values(?,?,?,?)',
                                [$data[0]->invest_id,$l4[0]->user_id,session()->get('id'),$per]);

                                $dd = Db::select('select * from comission order by comissionid desc limit 1');

                                Db::insert('insert into transaction(type,transaction_id,user_id,amount,status)
                                values(?,?,?,?,?)',[4,$dd[0]->comissionid,$l4[0]->user_id,$per,1]);

                            }
                        }

                        session()->flash('status', 'Invest Successfully');
                        return redirect('/plans');
                    }
                } else {

                    session()->flash('status', 'Invalid Amount Check Minimum and Maximum Amount');

                    return redirect()->back();
                }
            }

            session()->flash('status1', 'First You Deposit Amount');
            return redirect('/plans');
        }
        return redirect('/plans');
    }

    public function register($id)
    {

        if(session()->has('email')){

            return redirect('/');
        }
        else{


         $notification = Db::select('select * from notification_table limit 1');

        session()->put('notification', $notification[0]->notification_desc);


        $pid = (($id) / 2033149);

        $result = Db::select('select * from user where user_id = ?', [$pid]);
        if ($result) {

            return view('frontend.register', compact('pid'));
        } else {
            return redirect('/');
        }
    }

    }

    public function registerstore(Request $req, $id)
    {

        $pid = (($id) / 2033149);


        $req->validate([
            'name' => 'required | max:50',
            'phone' => 'required | max:12',
            'email' => 'required | email | max:50',
            'password' => 'required | min:6 | max:50',
            'conpassword' => 'required | max:50 | same:password',

        ]);

        $result1 = Db::select('select * from user where user_email = ?', [$req->email]);

        if ($result1) {
            session()->flash('status', 'Email Already Registered');
            return redirect()->back();
        } else {

            $result2 = DB::insert('insert into user (user_name,user_phone,user_email,user_password,status,parent_id,role) values (?,?,?,?,?,?,?)', [$req->name, $req->phone, $req->email, $req->password, 1, $id, 0]);
            if ($result2) {
                session()->flash('status1', 'You are Registered');
                return redirect()->back();
            }
        }
    }

    public function logout()
    {

        session()->forget('id');
        session()->forget('name');
        session()->forget('email');
        session()->forget('role');

        return redirect('/');
    }
}
