<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    public function dashboard()
    {

        // $data = DB::select('select * from invest inner join plan on invest.plan_id = plan.plan_id where now() between
        // invest.date and invest.end_date');



        $data = DB::select("SELECT * FROM `invest` inner join plan on invest.plan_id = plan.plan_id
        WHERE now() > date_add(date ,INTERVAL 24 hour) AND now() BETWEEN date AND end_date");

        // echo "<pre>";
        // print_r($data);

        if ($data) {
            // echo "<pre>";
            // print_r($data);

            foreach ($data as $item) {
                $date = $item->date;
                $investid = $item->invest_id;
                $userid = $item->user_id;
                $amount = $item->amount;
                $per = $item->daily_profit_percentage;
                $one_per = $amount / 100;
                $profit = $one_per * $per;

                $result2 =  Db::select("select * from profite where invest_id = ? and user_id = ? and date(date) = date(now())", [$investid, $userid]);

                if (!$result2) {

                    Db::insert("INSERT INTO profite(invest_id,user_id,amount,date,status)
                 VALUES ($investid,$userid,$profit,now(),1)");

                    $row = Db::select('select * from profite order by profite_id desc limit 1');

                    Db::insert('insert into transaction(type,transaction_id,user_id,amount,status)
                    values(?,?,?,?,?)', [3, $row[0]->profite_id, $userid, $profit, 1]);

                    // echo "thanks Profit Complete <br>";
                } else {
                    // echo "already given profit ";
                }

                //     echo "<pre>";
                // print_r($date);


                // $mm = Db::select("select * from invest where now() > $date ");
                //   $mm = Db::select("SELECT * FROM `invest` inner join plan on invest.plan_id = plan.plan_id
                //    WHERE now() > date_add(date ,INTERVAL 24 hour) AND now() BETWEEN date AND end_date");

                //     echo "<pre>";
                // print_r($mm);

                // print_r($mm);

                // if ($mm == null) {

                //     Db::insert("INSERT INTO profite(invest_id,user_id,amount,date,status)
                // VALUES ($investid,$userid,$profit,date_add(now(),interval 24 hour),1)");

                //     $row = Db::select('select * from profite order by profite_id desc limit 1');

                //     Db::insert('insert into transaction(type,transaction_id,user_id,amount,status)
                // values(?,?,?,?,?)', [3, $row[0]->profite_id, $userid, $profit, 1]);

                //     echo "thanks Profit Complete <br>";
                // }

            }
        }

        $result = Db::select('SELECT * FROM dollar_charges');
        session()->put('dollarrate', $result[0]->dollar_charge_amount);



        if (session()->get('role') == 0) {

            $deposit = Db::select('SELECT sum(transaction.amount) as depositamount from transaction, deposit INNER JOIN user on
            deposit.user_id = user.user_id where
        deposit.deposit_id  = transaction.transaction_id and deposit.user_id = ? and
        transaction.status = 1 and transaction.type = 0', [session()->get('id')]);

            $withdraw = Db::select('SELECT sum(transaction.amount) as withdrawamount from transaction,
            withdraw  INNER JOIN user on
        withdraw.user_id = user.user_id where withdraw.withdraw_id  = transaction.transaction_id and
        withdraw.user_id = ? and transaction.status = 1 and transaction.type = 1', [session()->get('id')]);

            $invest = Db::select('SELECT sum(transaction.amount) as investamount from transaction, invest
        INNER JOIN user on
        invest.user_id = user.user_id where invest.invest_id  = transaction.transaction_id and
        invest.user_id = ? and transaction.status = 1 and transaction.type = 2', [session()->get('id')]);

            $profit = Db::select('SELECT sum(profite.amount) as profitamount from profite inner join user on profite.user_id = user.user_id
            inner join transaction on transaction.transaction_id = profite.profite_id where user.user_id = ?
            and transaction.type = 3', [session()->get('id')]);


            $balance = $deposit[0]->depositamount - $invest[0]->investamount;
            $balance = $balance - $withdraw[0]->withdrawamount;

            $balance = $balance +  round($profit[0]->profitamount, 2);
        } else {

            $deposit = Db::select('SELECT sum(transaction.amount) as depositamount from transaction,
            deposit INNER JOIN user on deposit.user_id = user.user_id where
        deposit.deposit_id  = transaction.transaction_id  and transaction.type = 0 and transaction.status = 1');

            $withdraw = Db::select('SELECT sum(transaction.amount) as withdrawamount from transaction, withdraw
        INNER JOIN user on
        withdraw.user_id = user.user_id where withdraw.withdraw_id  = transaction.transaction_id
         and transaction.type = 1 and transaction.status = 1');

            $invest = Db::select('SELECT sum(transaction.amount) as investamount from transaction, invest
        INNER JOIN user on
        invest.user_id = user.user_id where invest.invest_id  = transaction.transaction_id
        and transaction.type = 2 and transaction.status = 1');

            $profit = Db::select('SELECT sum(profite.amount) as profitamount from profite inner join user on profite.user_id = user.user_id
            inner join transaction on transaction.transaction_id = profite.profite_id where transaction.type = 3');

            $balance = $deposit[0]->depositamount - $invest[0]->investamount;
            $balance =  $balance - $withdraw[0]->withdrawamount;
            $balance = $balance +  round($profit[0]->profitamount, 2);
        }

        $countuser =  Db::select('select count(*) as count from user where delstatus = 0 and role = 0');

        $deluser =  Db::select('select count(*) as count from user where delstatus = 1 and role = 0');


        return view('dashboard.index', compact('deposit', 'withdraw', 'balance', 'invest', 'profit', 'countuser', 'deluser'));
    }


    public function bankpaymentinfo()
    {

        $data = DB::select('select * from bank_payment');

        return view('dashboard.bank_payment_info', compact('data'));
    }
    public function addbankpaymentinfo()
    {
        return view('dashboard.add_bank_payment_info');
    }
    public function storebankpaymentinfo(Request $req)
    {

        $req->validate([
            'bank_name' => 'required | max:50',
            'account_title' => 'required | max:50',
            'account_number' => 'required | max:50',
            'status' => 'required',
        ]);

        Db::select(
            'INSERT INTO bank_payment(bank_name,account_title,account_number,status) VALUES (?,?,?,?)',
            [$req->bank_name, $req->account_title, $req->account_title, $req->status]
        );

        session()->flash('status', 'Bank Added');

        return redirect('/dashboard/bank-payment-info');
    }

    public function editbankpaymentinfo($id)
    {

        $data = Db::select('select * from bank_payment where bank_id = ?', [$id]);

        if ($data) {

            $data = $data[0];
            return view('dashboard.edit_bank_payment_info', compact('data'));
        }

        return redirect('/dashboard/bank-payment-info');
    }

    public function updatebankpaymentinfo(Request $req, $id)
    {

        $req->validate([
            'bank_name' => 'required | max:50',
            'account_title' => 'required | max:50',
            'account_number' => 'required | max:50',
        ]);

        $data = Db::select('select * from bank_payment where bank_id = ?', [$id]);

        if ($data) {

            Db::update('update bank_payment set bank_name = ? , account_title = ? ,
        account_number = ? , status = ? where bank_id = ?', [$req->bank_name, $req->account_title, $req->account_number, $req->status, $id]);

            session()->flash('status', 'Bank Updated');

            return redirect('/dashboard/bank-payment-info');
        }

        return redirect('/dashboard/bank-payment-info');
    }

    public function deletebankpaymentinfo($id)
    {

        $data = Db::select('select * from bank_payment where bank_id = ?', [$id]);

        if ($data) {

            Db::delete('delete from bank_payment where bank_id = ?', [$id]);

            return redirect('/dashboard/bank-payment-info');
        }

        return redirect('/dashboard/bank-payment-info');
    }
    public function notifications()
    {

        $data = Db::select('select * from notification_table');

        return view('dashboard.notification', compact('data'));
    }
    public function addnotifications()
    {

        return view('dashboard.add_notification');
    }

    public function storenotifications(Request $req)
    {

        $req->validate([
            'title' => 'required | max:30',
            'desc' => 'required',
            'date' => 'required',
            'status' => 'required',

        ]);

        $result = Db::insert('insert into notification_table(notification_title,notification_desc,date,status)
        values(?,?,?,?)', [$req->title, $req->desc, $req->date, $req->status]);

        if ($result) {

            session()->flash('status', 'Notification Inserted');

            return redirect('/dashboard/notifications');
        }
        return redirect('/dashboard/notifications');
    }

    public function editnotifications($id)
    {

        $data = Db::select('select * from notification_table where notification_id = ?', [$id]);

        if ($data) {

            $data = $data[0];

            return view('dashboard.edit_notification', compact('data'));
        }

        return redirect('/dashboard/notifications');
    }

    public function updatenotifications(Request $req, $id)
    {
        $req->validate([
            'title' => 'required | max:30',
            'desc' => 'required',
            'date' => 'required',
            'status' => 'required',

        ]);


        $data = Db::select('select * from notification_table where notification_id  = ?', [$id]);

        if ($data) {

            $result =   Db::update('update notification_table set notification_title  = ? , notification_desc = ?,
            status = ? , date = ? where notification_id  = ?', [$req->title, $req->desc, $req->status, $req->date, $id]);

            if ($result) {

                session()->flash('status', 'Notification Updated');

                return redirect('/dashboard/notifications');
            }
        }

        return redirect('/dashboard/notifications');
    }

    public function deletenotifications($id)
    {

        $data = Db::select('select * from notification_table where notification_id  = ?', [$id]);

        if ($data) {

            $result =   Db::delete('delete from notification_table where notification_id = ?', [$id]);

            if ($result) {

                session()->flash('status1', 'Notification Deleted');

                return redirect('/dashboard/notifications');
            }
        }

        return redirect('/dashboard/notifications');
    }

    public function myteam()
    {

        $i  = 1;
        $users = Db::select("select $i as level,B.parent_Level,A.user_name as Admin,A.user_id as parentid ,B.user_name as user_name
        ,B.user_id as user_id, B.user_email as user_email ,B.user_phone as user_phone,B.status as status, B.date as date
         from user as A inner join
        user as B on A.user_id = B.parent_id where A.user_id = ? order by A.parent_Level asc", [session()->get('id')]);

        $data = [];

        if ($users) {

            $data =  array_merge($data, $users);

            foreach ($users as $user) {
                $i = $i + 1;

                $users2 = Db::select("SELECT *,$i as level from user where parent_id = ? order by parent_Level asc", [$user->user_id]);

                $data = array_merge($data, $users2);

            }
                if ($users2) {

                    foreach ($users2 as $user) {
                        $users3 = Db::select("SELECT *,$i as level from user where parent_id = ? order by parent_Level asc", [$user->user_id]);
                        $data = array_merge($data, $users3);
                    }

                    foreach ($users3 as $user) {
                        $users4 = Db::select("SELECT *,$i as level from user where parent_id = ? order by parent_Level asc", [$user->user_id]);
                        $data = array_merge($data, $users4);
                    }

                    foreach ($users4 as $user) {
                        $users5 = Db::select("SELECT *,$i as level from user where parent_id = ? order by parent_Level asc", [$user->user_id]);
                        $data = array_merge($data, $users5);
                    }


                }

                $team =  DB::select('SELECT * FROM `teamcomission`');
            return view('dashboard.myteam', compact('data','team'));
        }

        return view('dashboard.myteam', compact('data','team'));

    }

    public function investeduser()
    {
        $users = Db::select('SELECT user.user_id,user_name,user_phone,user_email,user_password
        ,user.status,parent_id,user.date,sum(amount) as iamount FROM invest inner join user
        on user.user_id = invest.user_id where user.delstatus = 0  GROUP by invest.user_id,user.user_id,user.user_name,user.user_phone,user.user_email,user.user_password,user.status,user.parent_id,user.date');


        return view('dashboard.users', compact('users'));
    }
    public function edituser($id)
    {

        $user = Db::select('select * from user where user_id = ?', [$id]);
        if ($user) {
            $user = $user[0];
        }

        return view('dashboard.edit_user', compact('user'));
    }

    public function updateuser(Request $req, $id)
    {

        $req->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'status' => 'required',
            'password' => 'required'

        ]);

        $user = Db::select('select * from user where user_id = ?', [$id]);
        if ($user) {

            $result2 = Db::update('update user set user_name = ? , user_phone = ? , user_email = ? , user_password = ?, status = ?
            where user_id = ?', [$req->fullname, $req->phone, $req->email, $req->password, $req->status, $id]);

            if ($result2) {

                session()->flash('status', 'User Updated');
                return redirect('/dashboard/users');
            }
            return redirect('/dashboard/users');
        }
        return redirect('/dashboard/users');
    }

    public function deleteuser($id)
    {

        $user = Db::select('select * from user where user_id = ?', [$id]);
        if ($user) {

            $result = Db::update('update user set delstatus  = 1 where user_id = ?', [$id]);

            if ($result) {
                return redirect('/dashboard/users');
            }
            return redirect('/dashboard/users');
        }

        return redirect('/dashboard/users');
    }

    public function deletedusers()
    {

        $users = Db::select('select * from user where role != 3 and role != 4 and delstatus = 1');

        return view('dashboard.deletedusers', compact('users'));
    }


    public function detailuser($id)
    {
    }

    function users()
    {
        $users = Db::select('select * from user');
        return view('dashboard.alluser', compact('users'));
    }

    public function allcomission()
    {

        $data = Db::select('select * from user inner join comission on user.user_id = comission.from_user  where comission.user_id  = ?
        ', [session()->get('id')]);

        return view('dashboard.allcommissions', compact('data'));
    }

    public function teamcomission()
    {

        $data = Db::select('select * from teamcomission');

        return view('dashboard.teamcommissions', compact('data'));
    }

    public function editteamcomission($id)
    {

        $data = Db::select('select * from teamcomission where comissionid = ?', [$id]);
        if ($data) {

            $data = $data[0];
        } else {

            return redirect('/dashboard/teamcomission');
        }
        return view('dashboard.editteamcommission', compact('data'));
    }

    public function updateteamcomission(Request $req, $id)
    {

        $data = Db::select('select * from teamcomission where comissionid = ?', [$id]);
        if ($data) {

            Db::insert(
                'update  teamcomission set  comission_per  = ? where comissionid = ? ',
                [$req->percentage, $id]
            );

            return redirect('/dashboard/teamcomission');
        }

        return redirect('/dashboard/teamcomission');
    }

    public function withdrawcharges()
    {

        $data =  Db::select('select * from withdraw_charges');

        return view('dashboard.withdraw_charges', compact('data'));
    }



    public function addwithdrawcharges()
    {
        return view('dashboard.add_withdraw_charges');
    }

    public function storewithdrawcharges(Request $req)
    {

        $req->validate([
            'charges' => 'required'
        ]);


        $result = Db::insert('insert into withdraw_charges(charges) values(?)', [$req->charges]);

        if ($result) {

            session()->flash('status', 'Withdraw Inserted');

            return redirect('/dashboard/withdraw-charges');
        }

        return redirect('/dashboard/withdraw-charges');
    }



    public function editwithdrawcharges($id)
    {

        $data =   Db::select('select * from withdraw_charges where charges_id = ?', [$id]);

        if ($data) {
            $data = $data[0];

            return view('dashboard.edit_withdraw_charges', compact('data'));
        }
    }

    public function updatewithdrawcharges(Request $req, $id)
    {
        $data =  Db::select('select * from withdraw_charges where charges_id = ?', [$id]);

        if ($data) {

            Db::update(
                'update withdraw_charges set charges = ? where charges_id =? ',
                [$req->charges, $id]
            );

            session()->flash('status', 'Withdraw Charges Updated');

            return redirect('/dashboard/withdraw-charges');
        }

        return redirect('/dashboard/withdraw-charges');
    }

    public function withdraws()
    {
        $data = DB::select('select *,transaction.status as tstatus from transaction,withdraw inner join user on
        withdraw.user_id = user.user_id where transaction.transaction_id = withdraw.withdraw_id and transaction.type = 1 ');

        return view('dashboard.withdraws', compact('data'));
    }

    public function addwithdraws()
    {

        $payment = Db::select('select * from bank_payment');

        return view('dashboard.add_withdraws', compact('payment'));
    }

    public function storewithdraws(Request $req)
    {
        $req->validate([
            'amount' => 'required',
            'final_amount' => 'required',
            'account_number' => 'required'
        ]);

        $deposit = Db::select('SELECT sum(transaction.amount) as depositamount from transaction, deposit INNER JOIN user on
        deposit.user_id = user.user_id where
    deposit.deposit_id  = transaction.transaction_id and deposit.user_id = ? and
    transaction.status = 1 and transaction.type = 0', [session()->get('id')]);

        $withdraw = Db::select('SELECT sum(transaction.amount) as withdrawamount from transaction,
        withdraw  INNER JOIN user on
    withdraw.user_id = user.user_id where withdraw.withdraw_id  = transaction.transaction_id and
    withdraw.user_id = ? and transaction.status = 1 and transaction.type = 1', [session()->get('id')]);

        $invest = Db::select('SELECT sum(transaction.amount) as investamount from transaction, invest
    INNER JOIN user on
    invest.user_id = user.user_id where invest.invest_id  = transaction.transaction_id and
    invest.user_id = ? and transaction.status = 1 and transaction.type = 2', [session()->get('id')]);

        $balance = $deposit[0]->depositamount - $invest[0]->investamount;
        $balance = $balance - $withdraw[0]->withdrawamount;

        if ($req->final_amount <= $balance) {

            $result = Db::insert(
                'INSERT INTO withdraw(user_id, final_amount,bank_name,account_title,account_number) VALUES
            (?,?,?,?,?)',
                [
                    session()->get('id'), $req->final_amount, $req->bankname,
                    $req->holdername, $req->account_number
                ]
            );

            if ($result) {
                $result2 = Db::select('select * from withdraw order by withdraw_id desc limit 1');
                Db::insert(
                    'insert into transaction(type,transaction_id,user_id,amount,status) values(?,?,?,?,?)',
                    [1, $result2[0]->withdraw_id, session()->get('id'), $req->final_amount, 0]
                );

                session()->flash('status', 'Withdraw Request Sent');
                return redirect('/dashboard/withdraws');
            }
        } else {

            session()->flash('status1', 'Your Balance is Insufficient !');
        }
        return redirect('/dashboard/withdraws');
    }

    public function editwithdraws($id)
    {
        $data =   Db::select('select *,transaction.status as tstatus from transaction,withdraw inner join user on
        withdraw.user_id = user.user_id inner join bank_payment on bank_payment.bank_id = withdraw.bank_id where  transaction.transaction_id = withdraw.withdraw_id and
        transaction.type = 1  and withdraw_id = ?', [$id]);

        if ($data) {
            $data = $data[0];

            return view('dashboard.edit_withdraws', compact('data'));
        }
        return view('dashboard.edit_withdraws');
    }

    public function updatewithdraw(Request $req, $id)
    {
        $req->validate([
            'final_amount' => 'required',
            'account_title' => 'required',
            'account_number' => 'required',
        ]);
        $data =  Db::select('select * from withdraw where withdraw_id = ?', [$id]);
        if ($data) {
            Db::update(
                'update withdraw set final_amount = ? , account_title = ? , account_number = ? where withdraw_id =? ',
                [$req->final_amount, $req->account_title, $req->account_number, $id]
            );

            Db::update('update transaction set status = ? where transaction_id = ?', [$req->status, $id]);

            session()->flash('status', 'Withdraw Updated');
            return redirect('/dashboard/withdraws');
        }
        return redirect('/dashboard/withdraws');
    }

    public function deletewithdraw($id)
    {
        $data = Db::select('select * from withdraw where withdraw_id = ?', [$id]);

        $result  = Db::delete('delete from withdraw where withdraw_id = ?', [$id]);

        if ($result) {
            session()->flash('status1', 'withdraw Deleted');
            return redirect('/dashboard/withdraws');
        }
        return redirect('/dashboard/deposits');
    }


    public function deposits()
    {
        $charge = Db::select('select * from dollar_charges limit 1');

        if (session()->get('role') == 3 || session()->get('role') == 4) {

            $data = DB::select('SELECT *,transaction.date as tdate,transaction.status as tstatus from deposit
            inner join transaction on transaction.transaction_id = deposit.deposit_id
            inner join user on deposit.user_id = user.user_id
            where transaction.type = 0  ');
        } else {

            $data = DB::select('SELECT *,transaction.date as tdate,transaction.status as tstatus from deposit
            inner join transaction on transaction.transaction_id = deposit.deposit_id
            inner join user on deposit.user_id = user.user_id
            where transaction.type = 0 and deposit.user_id = ? ', [session()->get('id')]);
        }

        return view('dashboard.deposits', compact('data', 'charge'));
    }

    public function profits()
    {

        if (session()->get('role') == 3 || session()->get('role') == 4) {

            $data = DB::select('SELECT *,transaction.date as tdate,transaction.status as tstatus from profite
            inner join transaction on transaction.transaction_id = profite.profite_id
            inner join user on profite.user_id = user.user_id
            where transaction.type = 3  ');
        } else {

            $data = DB::select('SELECT *,transaction.date as tdate,transaction.status as tstatus from profite
            inner join transaction on transaction.transaction_id = profite.profite_id
            inner join user on profite.user_id = user.user_id
            where transaction.type = 3 and profite.user_id = ? ', [session()->get('id')]);
        }


        return view('dashboard.profits', compact('data'));
    }

    public function adddeposits()
    {
        $charge = Db::select('select * from dollar_charges limit 1');
        $payment = Db::select('SELECT * FROM bank_payment');
        return view('dashboard.add_deposits', compact('charge', 'payment'));
    }


    public function storedeposits(Request $req)
    {

        $req->validate([
            'myamount' => 'required',
            'transaction_file' => 'required | mimes:png,jpg',
        ]);


        $img = $req->transaction_file;
        $imgname = $img->getClientOriginalName();
        $imgname = Str::random(8) . '_' . $imgname;
        $img->move('public/transaction_images/', $imgname);

        $result = Db::insert(
            'INSERT INTO deposit(user_id,transaction_file) VALUES (?,?)',
            [session()->get('id'), $imgname]
        );
        session()->flash('status', 'Deposit Inserted');
        $amount = 0;
        if ($req->charge == 0) {
            $amount = $req->myamount / session()->get('dollarrate');
        } else {
            $amount = $req->myamount;
        }

        if ($result) {

            $result2 = Db::select('select * from deposit order by deposit_id desc limit 1');

            Db::insert(
                'insert into transaction(type,transaction_id,user_id,amount,status) values(?,?,?,?,?)',
                [0, $result2[0]->deposit_id, session()->get('id'), $amount, 0]
            );
            return redirect('/dashboard/deposits');
        }
        return redirect('/dashboard/deposits');
    }

    public function editdeposits($id)
    {
        $data = Db::select('SELECT *,transaction.date as tdate,transaction.status as tstatus from deposit
        inner join transaction on transaction.transaction_id = deposit.deposit_id
        inner join user on deposit.user_id = user.user_id
        where transaction.type = 0 and deposit.deposit_id  = ?', [$id]);
        if ($data) {
            $data = $data[0];
            return view('dashboard.edit_deposits', compact('data'));
        }
        return redirect('dashboard.edit_deposits');
    }

    public function updatedeposits(Request $req, $id)
    {
        $req->validate([
            'amount' => 'required',
        ]);

        $data = Db::select('SELECT *,transaction.date as tdate,transaction.status as tstatus from deposit
        inner join transaction on transaction.transaction_id = deposit.deposit_id
        inner join user on deposit.user_id = user.user_id
        where transaction.type = 0 and deposit.deposit_id  = ?', [$id]);

        if ($data) {

            Db::update(
                'update transaction set amount = ? , status = ? where transaction_id = ?',
                [$req->amount, $req->status, $id]
            );

            session()->flash('status', 'Deposit Updated');
            return redirect('/dashboard/deposits');
        }

        return redirect('/dashboard/deposits');
    }

    public function deletedeposits($id)
    {
        $data = Db::select('select * from deposit where deposit_id = ?', [$id]);
        if ($data) {
            // unlink('public/transaction_images/' . $data[0]->transaction_file);
            $result  = Db::delete('delete from deposit where deposit_id = ?', [$id]);

            if ($result) {
                session()->flash('status1', 'Deposit Deleted');
                return redirect('/dashboard/deposits');
            }
        }
        return redirect('/dashboard/deposits');
    }

    public function transactions()
    {

        if (session()->get('role') == 0) {
            $data = DB::select('select *,transaction.status as tstatus from transaction inner join user on transaction.user_id =
            user.user_id where user.user_id = ?', [session()->get('id')]);
        } else {
            $data = DB::select('select *,transaction.status as tstatus from transaction inner join user on transaction.user_id =
            user.user_id');
        }


        return view('dashboard.transactions', compact('data'));
    }

    public function addtransactions()
    {
        return view('dashboard.add_transactions');
    }

    public function storetransactions(Request $req)
    {
        $req->validate([
            'type' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);
        $result = Db::insert('INSERT INTO `transaction`(`type`, `amount`, `status`, `date`) VALUES (?,?,?,?)', [$req->type, $req->amount, 0, $req->date]);

        if ($result) {
            session()->flash('status', 'Transaction Inserted');
            return redirect('/dashboard/transactions');
        }
        return redirect('/dashboard/transactions');
    }


    public function edittransactions($id)
    {
        $data = Db::select('select * from transaction where transaction_id = ?', [$id]);
        if ($data) {
            $data = $data[0];
            return view('dashboard.edit_transactions', compact('data'));
        }
        return redirect('/dashboard/transaction');
    }

    public function updatetransactions(Request $req, $id)
    {
        $req->validate([
            'status' => 'required',
        ]);

        $data =  Db::select('select * from transaction where transaction_id = ?', [$id]);
        if ($data) {
            Db::update(
                'update transaction set status = ? where transaction_id = ?',
                [$req->status, $id]
            );
            session()->flash('status', 'Transaction Updated');

            return redirect('/dashboard/transactions');
        }

        return redirect('/dashboard/transactions');
    }


    public function plancategories()
    {

        $data = Db::select('select * from plan_category');

        return view('dashboard.plan_categories', compact('data'));
    }
    public function addplancategories()
    {
        return view('dashboard.add_plan_categories');
    }

    public function storeplancategories(Request $req)
    {

        $req->validate([
            'title' => 'required | max:30',
            'img' => 'required | image | mimes:png,jpg,jpeg',
            'status' => 'required',

        ]);

        $img = $req->img;
        $imgname = $img->getClientOriginalName();
        $imgname = Str::random(8) . '_' . $imgname;
        $img->move('public/planimg/', $imgname);

        $result = Db::insert('insert into plan_category(category_title,category_img,status)
        values(?,?,?)', [$req->title, $imgname, $req->status]);

        if ($result) {

            session()->flash('status', 'Plan Category Inserted');

            return redirect('/dashboard/plan-categories');
        }
        return redirect('/dashboard/plan-categories');
    }

    public function editplancategories($id)
    {

        $data = Db::select('select * from plan_category where cat_id = ?', [$id]);

        if ($data) {

            $data = $data[0];

            return view('dashboard.edit_plan_categories', compact('data'));
        }

        return redirect('/dashboard/plan-categories');
    }

    public function updateplancategories(Request $req, $id)
    {

        $req->validate([
            'title' => 'required | max:30',
            'status' => 'required',

        ]);

        $data = Db::select('select * from plan_category where cat_id = ?', [$id]);

        if ($data) {


            if ($req->img) {

                $img = $req->img;
                $imgname = $img->getClientOriginalName();
                $imgname = Str::random(8) . '_' . $imgname;
                $img->move('public/planimg/', $imgname);
                unlink('public/planimg/' . $data[0]->category_img);
            } else {
                $imgname = $req->oldimg;
            }

            Db::update('update plan_category set category_title = ? , category_img = ? ,
            status = ? where cat_id = ?', [$req->title, $imgname, $req->status, $id]);

            session()->flash('status', 'Plan Category Updated');


            return redirect('/dashboard/plan-categories');
        }

        return redirect('/dashboard/plan-categories');
    }

    public function deleteplancategories($id)
    {

        $data = Db::select('select * from plan_category where cat_id = ?', [$id]);

        if ($data) {

            unlink('public/planimg/' . $data[0]->category_img);

            $result  = Db::delete('delete from plan_category where cat_id = ?', [$id]);

            if ($result) {



                session()->flash('status1', 'Plan Category Deleted');


                return redirect('/dashboard/plan-categories');
            }
        }
        return redirect('/dashboard/plan-categories');
    }


    public function plans()
    {
        $data =  Db::select('SELECT *,plan.status as pstatus from plan INNER join plan_category on plan.cat_id = plan_category.cat_id');
        return view('dashboard.plans', compact('data'));
    }
    public function addplan()
    {
        $category = Db::select('SELECT * FROM plan_category');
        return view('dashboard.add_plan', compact('category'));
    }

    public function storeplan(Request $req)
    {

        $req->validate([
            'title' => 'required | max:50',
            'plancat' => 'required',
            'minamount' => 'required',
            'maxamount' => 'required',
            'durnumber' => 'required',
            'durtype' => 'required',
            'daily_profit' => 'required',
            'profitdaily' => 'required',
            'status' => 'required'
        ]);

        Db::insert(
            'INSERT INTO plan(plan_title,cat_id ,minimum_amount, maximum_amount,
        duration_number, duration_type, daily_profit_percentage,
        profit_daily, status) VALUES (?,?,?,?,?,?,?,?,?)',
            [
                $req->title, $req->plancat, $req->minamount, $req->maxamount, $req->durnumber,
                $req->durtype, $req->daily_profit, $req->profitdaily, $req->status
            ]
        );

        session()->flash('status', 'Plan Inserted');

        return redirect('/dashboard/plans');
    }

    public function editplan($id)
    {
        $data = Db::select('select * from plan where plan_id = ?', [$id]);
        $category = Db::select('select * from plan_category');
        if ($data) {

            $data = $data[0];

            return view('dashboard.edit_plan', compact('data', 'category'));
        }
        return redirect('dashboard.edit_plan');
    }

    public function updateplan(Request $req, $id)
    {
        $req->validate([
            'title' => 'required | max:50',
            'plancat' => 'required',
            'minamount' => 'required',
            'maxamount' => 'required',
            'durnumber' => 'required',
            'durtype' => 'required',
            'daily_profit' => 'required',
            'profitdaily' => 'required',
            'status' => 'required'
        ]);

        $data = Db::select('select * from plan where plan_id = ?', [$id]);

        if ($data) {

            Db::update('update plan set plan_title = ? , minimum_amount = ? , maximum_amount = ? ,
            duration_number = ? , duration_type = ? , daily_profit_percentage = ? ,profit_daily = ? ,
            cat_id = ? ,
             status = ? where plan_id = ?', [
                $req->plan_title, $req->minimum_amount, $req->maximum_amount,
                $req->duration_number, $req->duration_type, $req->daily_profit_percentage, $req->profit_daily, $req->cat_id,
                $req->status,  $id
            ]);
            session()->flash('status', 'Plan Updated');
            return redirect('/dashboard/plans');
        }

        return redirect('/dashboard/plans');
    }

    public function deleteplan($id)
    {
        $data = Db::select('select * from plan where plan_id = ?', [$id]);

        if ($data) {

            $result  = Db::delete('delete from plan where plan_id = ?', [$id]);

            if ($result) {
                session()->flash('status1', 'Plan Deleted');
                return redirect('/dashboard/plans');
            }
        }
        return redirect('/dashboard/plans');
    }

    public function investments()
    {

        if (session()->get('role') == 0) {

            $data = Db::select('select *,invest.status as istatus,invest.date as idate  from invest inner join plan on invest.plan_id = plan.plan_id inner join
            user on invest.user_id = user.user_id
            where user.user_id = ?', [session()->get('id')]);
        } else {
            $data = Db::select('select *,invest.status as istatus,invest.date as idate from invest inner join plan on invest.plan_id = plan.plan_id inner join
            user on invest.user_id = user.user_id');
        }

        return view('dashboard.investments', compact('data'));
    }
    public function addinvestments()
    {

        return view('dashboard.add_investments');
    }
    public function editinvestments()
    {
        return view('dashboard.edit_investments');
    }
}
