<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

*/

// Dashboard Routes :

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['login']);
Route::get('/dashboard/bank-payment-info', [DashboardController::class, 'bankpaymentinfo'])->middleware(['login','alogin']);
Route::get('/dashboard/add-bank-payment-info', [DashboardController::class, 'addbankpaymentinfo'])->middleware(['login','alogin']);
Route::post('/dashboard/add-bank-payment-info-store', [DashboardController::class, 'storebankpaymentinfo'])->middleware(['login','alogin']);
Route::get('/dashboard/edit-bank-payment-info/{id}', [DashboardController::class, 'editbankpaymentinfo'])->middleware(['login','alogin']);
Route::post('/dashboard/update-bank-payment-info/{id}', [DashboardController::class, 'updatebankpaymentinfo'])->middleware(['login','alogin']);
Route::get('/dashboard/delete-bank-payment-info/{id}', [DashboardController::class, 'deletebankpaymentinfo'])->middleware(['login','alogin']);
Route::get('/dashboard/notifications', [DashboardController::class, 'notifications'])->middleware(['login','alogin']);
Route::get('/dashboard/add-notifications', [DashboardController::class, 'addnotifications'])->middleware(['login','alogin']);
Route::post('/dashboard/store-notifications', [DashboardController::class, 'storenotifications'])->middleware(['login','alogin']);
Route::get('/dashboard/edit-notifications/{id}', [DashboardController::class, 'editnotifications'])->middleware(['login','alogin']);
Route::post('/dashboard/update-notifications/{id}', [DashboardController::class, 'updatenotifications'])->middleware(['login','alogin']);
Route::get('/dashboard/delete-notifications/{id}', [DashboardController::class, 'deletenotifications'])->middleware(['login','alogin']);
Route::get('/dashboard/invested-user', [DashboardController::class, 'investeduser'])->middleware(['login','alogin']);
Route::get('/dashboard/users', [DashboardController::class, 'users'])->middleware(['login','alogin']);
Route::get('/dashboard/edit-invested-user/{id}', [DashboardController::class, 'edituser'])->middleware(['login','alogin']);
Route::post('/dashboard/update-invested-user/{id}', [DashboardController::class, 'updateuser'])->middleware(['login','alogin']);
Route::get('/dashboard/delete-invested-user/{id}', [DashboardController::class, 'deleteuser'])->middleware(['login','alogin']);
Route::get('/dashboard/deleted-users', [DashboardController::class, 'deletedusers'])->middleware(['login','alogin']);
Route::get('/dashboard/detail-user/{id}', [DashboardController::class, 'detailuser'])->middleware(['login','alogin']);
Route::get('/dashboard/my-team', [DashboardController::class, 'myteam'])->middleware(['login']);

Route::get('/dashboard/withdraw-charges', [DashboardController::class, 'withdrawcharges'])->middleware(['login','alogin']);
Route::get('/dashboard/add-withdraw-charges', [DashboardController::class, 'addwithdrawcharges'])->middleware(['login','alogin']);
Route::post('/dashboard/store-withdraw-charges', [DashboardController::class, 'storewithdrawcharges'])->middleware(['login','alogin']);
Route::get('/dashboard/edit-withdraw-charges/{id}', [DashboardController::class, 'editwithdrawcharges'])->middleware(['login','alogin']);
Route::post('/dashboard/update-withdraw-charges/{id}', [DashboardController::class, 'updatewithdrawcharges'])->middleware(['login','alogin']);
Route::get('/dashboard/withdraws', [DashboardController::class, 'withdraws'])->middleware(['login']);
Route::get('/dashboard/add-withdraws', [DashboardController::class, 'addwithdraws'])->middleware(['login']);
Route::post('/dashboard/store-withdraw', [DashboardController::class, 'storewithdraws'])->middleware(['login']);
Route::get('/dashboard/edit-withdraws/{id}', [DashboardController::class, 'editwithdraws'])->middleware(['login','alogin']);
Route::post('/dashboard/update-withdraw/{id}', [DashboardController::class, 'updatewithdraw'])->middleware(['login','alogin']);
Route::get('/dashboard/delete-withdraws/{id}', [DashboardController::class, 'deletewithdraw'])->middleware(['login','alogin','mlogin']);
Route::get('/dashboard/deposits', [DashboardController::class, 'deposits'])->middleware(['login']);
Route::get('/dashboard/add-deposits', [DashboardController::class, 'adddeposits'])->middleware(['login']);
Route::post('/dashboard/add-deposit-amount', [DashboardController::class, 'adddepositsamount'])->middleware(['login']);
Route::get('/dashboard/profits', [DashboardController::class, 'profits'])->middleware(['login']);

Route::post('/dashboard/store-deposits', [DashboardController::class, 'storedeposits'])->middleware(['login']);
Route::get('/dashboard/edit-deposits/{id}', [DashboardController::class, 'editdeposits'])->middleware(['login','alogin']);
Route::post('/dashboard/update-deposit/{id}', [DashboardController::class, 'updatedeposits'])->middleware(['login','alogin']);
Route::get('/dashboard/delete-deposits/{id}', [DashboardController::class, 'deletedeposits'])->middleware(['login','alogin']);




Route::get('/dashboard/transactions', [DashboardController::class, 'transactions'])->middleware(['login']);
Route::get('/dashboard/add-transactions', [DashboardController::class, 'addtransactions'])->middleware(['login']);
Route::post('/dashboard/store-transaction', [DashboardController::class, 'storetransactions'])->middleware(['login']);
Route::get('/dashboard/edit-transactions/{id}', [DashboardController::class, 'edittransactions'])->middleware(['login']);
Route::post('/dashboard/update-transactions/{id}', [DashboardController::class, 'updatetransactions'])->middleware(['login']);
Route::get('/dashboard/plan-categories', [DashboardController::class, 'plancategories'])->middleware(['login','alogin']);
Route::get('/dashboard/add-plan-categories', [DashboardController::class, 'addplancategories'])->middleware(['login','alogin']);
Route::post('/dashboard/store-plan-categories', [DashboardController::class, 'storeplancategories'])->middleware(['login','alogin']);
Route::get('/dashboard/edit-plan-categories/{id}', [DashboardController::class, 'editplancategories'])->middleware(['login','alogin']);
Route::post('/dashboard/update-plan-categories/{id}', [DashboardController::class, 'updateplancategories'])->middleware(['login','alogin']);
Route::get('/dashboard/delete-plan-categories/{id}', [DashboardController::class, 'deleteplancategories'])->middleware(['login','alogin']);
Route::get('/dashboard/plans', [DashboardController::class, 'plans'])->middleware(['login','alogin']);
Route::get('/dashboard/add-plan', [DashboardController::class, 'addplan'])->middleware(['login','alogin']);
Route::post('/dashboard/store-plan', [DashboardController::class, 'storeplan'])->middleware(['login','alogin']);
Route::get('/dashboard/edit-plan/{id}', [DashboardController::class, 'editplan'])->middleware(['login','alogin']);
Route::post('/dashboard/update-plan/{id}', [DashboardController::class, 'updateplan'])->middleware(['login','alogin']);
Route::get('/dashboard/delete-plan/{id}', [DashboardController::class, 'deleteplan'])->middleware(['login','alogin']);
Route::get('/dashboard/investments', [DashboardController::class, 'investments'])->middleware(['login']);
Route::get('/dashboard/allcomission', [DashboardController::class, 'allcomission'])->middleware(['login']);
Route::get('/dashboard/teamcomission', [DashboardController::class, 'teamcomission'])->middleware(['login']);
Route::get('/dashboard/edit-teamcomission/{id}', [DashboardController::class, 'editteamcomission'])->middleware(['login','alogin']);
Route::post('/dashboard/update-teamcomission/{id}', [DashboardController::class, 'updateteamcomission'])->middleware(['login','alogin']);


// website Routes

Route::get('/register', function () {
    // $id = 1 * 2033149;
    $rto = "/register" . "/0";
    return redirect($rto);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/plans', [HomeController::class, 'plans']);
Route::get('/invest/{id}', [HomeController::class, 'invest'])->middleware('login');
Route::post('/investstore/{id}', [HomeController::class, 'investstore'])->middleware('login');
Route::get('/contact', [HomeController::class, 'contact']);
Route::post('/contact-store', [HomeController::class, 'contactstore']);
Route::get('/login', [HomeController::class, 'login']);
Route::post('/login-store', [HomeController::class, 'loginstore']);
Route::get('/register/{id}', [HomeController::class, 'register']);
Route::post('/register-store/{id}', [HomeController::class, 'registerstore']);
Route::get('/logout', [HomeController::class, 'logout']);

// Route::get('/session', function () {

//     echo "<pre>";
//     print_r(session()->all());
// });

Route::get('/team',function(){

    $pr = 2;

    $dd = Db::select('select * from user where parent_id = ?',[$pr]);
    echo "<pre>";
    print_r($dd);

    foreach($dd as $item){

       $nn =  Db::select('select * from user where parent_id = ?',[$item->parent_id]);
       echo "<pre>";
       print_r($nn);

    }



    // $users = Db::select('select * from user');

    // echo "<pre>";
    // print_r($users);

});

