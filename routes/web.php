<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendParcelController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\reportingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/








Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/users/all',[HomeController::class, 'getusers'])->name('users.data');

Route::get('User/detail/{id}', [HomeController::class, 'userDetail'])->name('userDetail');
Route::get('user/disabled/{id}', [HomeController::class, 'userDisabled'])->name('userDisabled');
Route::get('user/active/{id}', [HomeController::class, 'useractive'])->name('useractive');




Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');





// forgot password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');



Route::post('/forgot-password', function (Request $request) {
    $validateData = $request->validate([
        'email' => 'required',
    ],
    [
        'email.required' => 'Email (requis',
     
    ]);

 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __("Nous avons envoyé votre lien de réinitialisation de mot de passe par e-mail !")])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');





Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');










// admin login
Route::get('/adminRegister',[ProfileController::class, 'adminLogin'])->name('adminLogin');


// register route
Route::post('/profile',[ProfileController::class, 'profile'])->name('profile');
// admin login form 
Route::post('/adminLoginForm',[ProfileController::class, 'adminLoginForm'])->name('adminLoginForm');


// my profile page
Route::get('/MyProfile',[ProfileController::class, 'MyProfile'])->name('MyProfile');
// profile update
Route::post('/profile/update/{id}',[ProfileController::class, 'ProfileUpdate']);
// profile update
Route::post('/profile/update/password/{id}',[ProfileController::class, 'ProfileUpdatePass']);
// change password page
Route::get('/change/password',[ProfileController::class, 'ChangPas']);




// send a parcel
Route::get('/SendParcel',[SendParcelController::class, 'sendParcel'])->name('SendParcel');
Route::get('/SuccessParcel',[SendParcelController::class, 'successParcel'])->name('successParcel');

// insert parcel
Route::post('/insert/parcel',[SendParcelController::class, 'insert']);

// my devices page
Route::get('/MyDevices',[DeviceController::class, 'myDevices'])->name('myDevices');
// device edit page
Route::get('/Parcel/Detail/{id}',[DeviceController::class, 'EditDevice'])->name('EditDevice');
// device note page
Route::get('/Parcel/Note/{id}',[DeviceController::class, 'NoteParcel'])->name('NoteParcel');
// device delete page
Route::get('/Parcel/Delete/{id}',[DeviceController::class, 'DeleteDevice'])->name('DeleteDevice');
// search device
Route::get('search/device',[DeviceController::class, 'searchdevice']);





// MyQuotes page
Route::get('/MyQuotes',[QuotesController::class, 'myQuotes'])->name('myQuotes');
// quotes value order now
Route::post('/quotes/value/{id}',[QuotesController::class, 'quotesValue']);
// search quote
Route::get('search/quote',[QuotesController::class, 'searchquote']);




//MySupport page
Route::get('/MySupport',[SupportController::class, 'mySupport'])->name('mySupport');
// support detail
Route::get('/Support/Detail/{id}',[SupportController::class, 'EditSupport'])->name('EditSupport');
// add support
Route::post('/support/add',[SupportController::class, 'AddSupport']);
// add support new
Route::post('/support/add/new',[SupportController::class, 'AddSupportNew']);
// search support
Route::get('search/support',[SupportController::class, 'searchsupport']);






// approved order
Route::get('/orderNotiuser',[OrderController::class, 'orderNotiuser'])->name('orderNotiuser');


//prnpriview Page
Route::get('/prnpriview/{id}',[OrderController::class, 'prnpriview'])->name('prnpriview');

//MyOrder Page
Route::get('/MyOrder',[OrderController::class, 'myOrder'])->name('MyOrder');
// user orders
Route::get('/userOrder',[OrderController::class, 'userorder'])->name('userorder')->middleware('userOrder');
// user orders approved
Route::post('/order/approved/{id}',[OrderController::class, 'orderApproved'])->name('orderApproved');
// Approved/order/detail
Route::get('Approved/order/detail/{id}',[OrderController::class, 'ApprovedOrderDetail'])->name('ApprovedOrderDetail');
// approved order note
Route::get('Approved/order/notes/{id}',[OrderController::class, 'ApprovedOrderNotes'])->name('ApprovedOrderNotes');
// add notes
Route::post('/order/notes/{id}',[OrderController::class, 'orderNotes'])->name('orderNotes');
// quotes detail
Route::get('/quotes/detail/{id}',[OrderController::class, 'quotesDetail'])->name('quotesDetail');

// approved order
Route::get('/ApprovedOrder',[OrderController::class, 'ApprovedOrder'])->name('ApprovedOrder');
// refuse order
Route::post('/order/refuse',[OrderController::class, 'RefuseOrder']);
// recieved order
Route::post('/order/recieved',[OrderController::class, 'recievedOrder']);
// progress order
Route::post('/order/progress',[OrderController::class, 'progressOrder']);
// waiting order
Route::post('/order/waiting',[OrderController::class, 'waitingOrder']);
// repair order
Route::post('/order/repair',[OrderController::class, 'repairOrder']);
// return order
Route::post('/order/return',[OrderController::class, 'returnOrder']);


//Noti/ok
Route::get('/Noti/ok',[OrderController::class, 'NotiOK'])->name('NotiOK');
//Noti2/ok
Route::get('/Noti2/ok',[OrderController::class, 'Noti2OK'])->name('Noti2OK');

// pay order
Route::post('/order/pay',[OrderController::class, 'payOrder']);


// uploadPDF/page
Route::get('upload/pdf/page/{id}',[OrderController::class, 'uploadPDFpage']);


// upload pdf
Route::post('/upload/pdf/{id}',[OrderController::class, 'uploadpdf']);







// quotes order
Route::get('/userQuotes',[OrderController::class, 'userQuotes'])->name('userQuotes')->middleware('userQuotes');
// quotes approved
Route::post('/quotes/approved/{id}',[OrderController::class, 'quotesApproved'])->name('quotesApproved');
// refuse quotes
Route::post('/quote/refuse',[OrderController::class, 'RefuseQuote']);
// search order
Route::get('search/user/order',[OrderController::class, 'searchOrder']);
// yajra for service
Route::get('/all/order/get',[OrderController::class, 'getOrders'])->name('userOrder.data');
// search quotes
Route::get('search/user/quotes/',[OrderController::class, 'searchQuote']);







// my bill page
Route::get('/MyBill',[BillController::class, 'myBill'])->name('myBill');
// bill edit page
Route::get('/Mybill/Detail/{id}',[BillController::class, 'EditBill'])->name('EditBill');
// search bill
Route::get('search/bill',[BillController::class, 'searchbill']);
// /Mybill/Payer/Detail
Route::get('/Mybill/Payer/detail/{id}',[BillController::class, 'PayerBillDetail'])->name('PayerBillDetail');

// bill edit page
Route::get('/Mybill/Payer/{id}',[BillController::class, 'PayerBill'])->name('PayerBill');


///download/pdf/user
Route::get('/download/pdf/user/{file}',[BillController::class, 'DownloadPDFUser']);






// user problem page
Route::get('/problem',[ProblemController::class, 'problem'])->middleware('admin');
// yajra
Route::get('/problem/get',[ProblemController::class, 'getproblem'])->name('problem.data');

// problem detail page
Route::get('/problem/Detail/{id}',[ProblemController::class, 'problemDetail'])->name('problemDetail');
// probelm reply 
Route::post('/problem/reply',[ProblemController::class, 'ReplyProb']);



// Notfication page
Route::get('/notification',[NotificationController::class, 'notification'])->name('notification');
// notification detail
Route::get('/notification/detail/{id}',[NotificationController::class, 'notiDetail'])->name('notiDetail');


// s upport wallet
Route::get('/SupportWallet',[OrderController::class, 'SupportWallet'])->name('SupportWallet');
// s upport wallet/Credits
Route::get('/SupportWallet/Credits',[OrderController::class, 'SupportWalletCredit'])->name('SupportWalletCredit');



// search norapproved
Route::get('search/norapproved/',[OrderController::class, 'searchnorapproved']);
// search okapproved
Route::get('search/okapproved',[OrderController::class, 'searchokapproved']);



// payment
Route::post('/pay',[PaymentController::class, 'pay'])->name('payment');
Route::get('success', [PaymentController::class, 'success']);
Route::get('error', [PaymentController::class, 'error']);

//////// searcj /////////
// search norapproved
Route::get('search/usersadmin/',[UserController::class, 'searchnorapproved']);






////////////////////////////////////////////////////// new routes/////////////////////////////////////////////// 


// configuration
Route::get('/configuration',[ConfigurationController::class, 'index'])->name('index');
// brand
Route::get('/configuration/Marque',[ConfigurationController::class, 'brands']);
// yajra for brand
Route::get('/configuration/brands',[ConfigurationController::class, 'getbrands'])->name('datatables.data');
// add brand
Route::post('/config/brand/add',[ConfigurationController::class, 'addBrands']);
// edit barnd page
Route::get('/brand/edit/{id}',[ConfigurationController::class, 'editBrand']);
// update brand
Route::post('/config/brand/update/{id}',[ConfigurationController::class, 'updateBrands']);
// delete barnd page
Route::get('/brand/delete/{id}',[ConfigurationController::class, 'DeleteBrand']);
///brand/active/
Route::get('/Active/Marque/{id}',[ConfigurationController::class, 'brandActive']);


// product page
Route::get('/configuration/Produit',[ConfigurationController::class, 'Products']);
// yajra for brand
Route::get('/configuration/Product',[ConfigurationController::class, 'getproducts'])->name('products.data');
// add product
Route::post('/config/product/add',[ConfigurationController::class, 'addProducts']);
// edit product page
Route::get('/product/edit/{id}',[ConfigurationController::class, 'editProducts']);
// update product
Route::post('/config/product/update/{id}',[ConfigurationController::class, 'updateProducts']);
// delete product page
Route::get('/product/delete/{id}',[ConfigurationController::class, 'DeleteProducts']);
///product/active/
Route::get('/product/active/{id}',[ConfigurationController::class, 'productActive']);









// services page
Route::get('/configuration/Services',[ConfigurationController::class, 'Services']);
// yajra for service
Route::get('/configuration/service',[ConfigurationController::class, 'getservices'])->name('services.data');

// add service
Route::post('/config/service/add',[ConfigurationController::class, 'addServices']);
// edit service page
Route::get('/service/edit/{id}',[ConfigurationController::class, 'editServices']);
// update service
Route::post('/config/service/update/{id}',[ConfigurationController::class, 'updateServices']);
// delete service page
Route::get('/service/delete/{id}',[ConfigurationController::class, 'DeleteServices']);
// fetch product data
Route::get('/product/fetch/data',[ConfigurationController::class, 'fetchProduct']);

///service/active/
Route::get('/service/active/{id}',[ConfigurationController::class, 'serviceActive']);


// to do list
Route::get('/todolist',[ToDoListController::class, 'index']);
// add new task
Route::post('/add/task',[ToDoListController::class, 'addTask']);
// yajra for to do list
Route::get('/get/task',[ToDoListController::class, 'gettask'])->name('todolist.data');
// edit task page
Route::get('/task/edit/page/{id}',[ToDoListController::class, 'TaskEditPage']);
// update service
Route::post('/update/task/{id}',[ToDoListController::class, 'updateTask']);


// edit task page
Route::get('/task/edit/{id}',[ToDoListController::class, 'editTask']);
// edit task incom
Route::get('/task/incom/{id}',[ToDoListController::class, 'incomTask']);
// edit task fav
Route::get('/task/fav/{id}',[ToDoListController::class, 'favTask']);


// completeb task list
Route::get('/comlist',[ToDoListController::class, 'comlist']);
// yajra boc for complete list
Route::get('/com/task',[ToDoListController::class, 'getcom'])->name('comlist.data');


// fav list page
Route::get('/favlist',[ToDoListController::class, 'favlist']);
// yajra boc for complete list
Route::get('/fav/task',[ToDoListController::class, 'getfav'])->name('favlist.data');




// vendor list
Route::get('/vendorlist',[ToDoListController::class, 'vendorlist']);
// yajra for to do vendor
Route::get('/get/vendor',[ToDoListController::class, 'getvendor'])->name('vendorlist.data');
// add vendor
Route::post('/add/vendor',[ToDoListController::class, 'addVendor']);
// edit vendor page
Route::get('/vendor/edit/page/{id}',[ToDoListController::class, 'vendorEditPage']);
// update vendor
Route::post('/update/vendor/{id}',[ToDoListController::class, 'updatevendor']);
// update vendor
Route::post('/update/vendor/{id}',[ToDoListController::class, 'updatevendor']);
// delete vendor page
Route::get('/vendor/delete/{id}',[ToDoListController::class, 'DeleteVendor']);
// vendor fav
Route::get('/vendor/fav/{id}',[ToDoListController::class, 'favvendor']);
// vendor detail
Route::get('/vendor/detail/{id}',[ToDoListController::class, 'detailVendor']);

// vendorfavlist
Route::get('/vendorfavlist',[ToDoListController::class, 'vendorfavlist']);
// yajra boc for complete list
Route::get('/fav/vendor',[ToDoListController::class, 'getvendorfav'])->name('venforfavlist.data');

// inventory
Route::get('/inventory',[inventoryController::class, 'inventory']);

// inventory/add
Route::get('/inventory/add',[inventoryController::class, 'inventoryAdd']);
// fetch prduct
Route::get('/brand/fetch/inv',[inventoryController::class, 'FetchProduct']);
// fetch service
Route::get('/service/fetch/inv',[inventoryController::class, 'FetchService']);
// fetch service data
Route::get('/service/fetch/data/inv',[inventoryController::class, 'FetchServicedata']);
// fetch product data
Route::post('/inventory/data/add',[inventoryController::class, 'insertDataInv']);
// edit inventory page
Route::get('/inventory/edit/{id}',[inventoryController::class, 'inventoryedit']);


// reporting
Route::get('/reporting',[reportingController::class, 'reporting']);
// /today/report
Route::get('/today/report',[reportingController::class, 'todayreport']);
// search /today/report
Route::get('/today/report/search',[reportingController::class, 'searchToday']);




// search /today/credit/report
Route::get('/today/credit/report/search',[reportingController::class, 'searchTodaycredit']);
// search /monthly/credit/report
Route::get('/monthly/credit/report/search',[reportingController::class, 'searchmonthlycredit']);

// search /monthly/admincredit/report
Route::get('/monthly/admincredit/report/search',[reportingController::class, 'searchmonthlyadmincredit']);

// /today/user/credit/report
Route::get('/today/user/credit/report',[reportingController::class, 'todayUserCreditreport']);
// /today/admin/credit/report
Route::get('/today/admin/credit/report',[reportingController::class, 'todayadminCreditreport']);

// search /today/admin/credit/report
Route::get('/today/admin/credit/report/search',[reportingController::class, 'searchTodayAdmincredit']);
// /monthly/admin/credit/report
Route::get('/monthly/admin/credit/report',[reportingController::class, 'monthlyadminCreditreport']);


// /monthly/user/credit/report
Route::get('/monthly/user/credit/report',[reportingController::class, 'monthlyUserCreditreport']);
// order today yajra
Route::get('/today/report/all',[reportingController::class, 'todayreportdata'])->name('order.todday.data');
// search order today
Route::post('/search/today/order',[reportingController::class, 'searchOrdertoday']);
// search order all
Route::get('/search/all/order',[reportingController::class, 'searchOrderall']);
// search order all sale
Route::post('/search/all/sale',[reportingController::class, 'searchOrdersale']);
// search order all purchase
Route::post('/search/all/purchase',[reportingController::class, 'searchOrderpurchase']);
// search order all profit
Route::post('/search/all/profit',[reportingController::class, 'searchOrderprofit']);
// /search/user/credit/report
Route::get('/search/user/credit/report',[reportingController::class, 'searchUserCreditreport']);
// search UserCredit all
Route::get('/search/all/userCredit',[reportingController::class, 'searchUserCreditall']);


// adminUser
Route::get('/adminUser',[UserController::class, 'adminUser']);
// search norapproved
Route::get('search/usersadmin/',[UserController::class, 'usersadmin']);

// /monthly/report
Route::get('/monthly/report',[reportingController::class, 'monthlyreport']);

// search order monthly
Route::get('/search/monthly/order',[reportingController::class, 'searchOrdermonthly']);

// /search/report
Route::get('/search/report',[reportingController::class, 'searchreport']);




// /search/admin/credit/report
Route::get('/search/admin/credit/report',[reportingController::class, 'searchadminCreditreport']);
// /search/admin/credits
Route::get('/search/admin/credits',[reportingController::class, 'searchAdminCredits']);

////////////////////////////////////// Ua=ser sdie///////////////////////////////////
// brnad fetach data on user 
Route::get('/brand/fetach/data',[UserController::class, 'fetchbrandproduct']);
// product fetach data on user 
Route::get('/product/fetach/data',[UserController::class, 'fetchproducctservice']);








///////////////////////////////////////pdf section here///////////////////////////////////////////////

//////////////////////////////// pdf of user tabel here///////////////////////////////
Route::get('/userPDF',[PDFController::class, 'userPDF']);
// inventory pdf here
Route::get('/inventoryPDF',[PDFController::class, 'inventoryPDF']);
// userOrderPDF
Route::get('/userOrderPDF',[PDFController::class, 'userOrderPDF']);
// userQuotePDF
Route::get('/userQuotePDF',[PDFController::class, 'userQuotePDF']);
// todolistPDF
Route::get('/todolistPDF',[PDFController::class, 'todolistPDF']);
// favPDF
Route::get('/favPDF',[PDFController::class, 'favPDF']);
// taskComPDF
Route::get('/taskComPDF',[PDFController::class, 'taskComPDF']);
// vendorListPDF
Route::get('/vendorListPDF',[PDFController::class, 'vendorListPDF']);
// favVendorPDF
Route::get('/favVendorPDF',[PDFController::class, 'favVendorPDF']);
// brandPDF
Route::get('/brandPDF',[PDFController::class, 'brandPDF']);
// productPDF
Route::get('/productPDF',[PDFController::class, 'productPDF']);

// todayOrderPDF
Route::get('/todayOrderPDF',[PDFController::class, 'todayOrderPDF']);
// monthOrderPDF
Route::get('/monthOrderPDF',[PDFController::class, 'monthOrderPDF']);
// userOrderSearchPDF
Route::get('/userOrderSearchPDF',[PDFController::class, 'userOrderSearchPDF']);

// todayOrderCreditPDF
Route::get('/todayOrderCreditPDF',[PDFController::class, 'todayOrderCreditPDF']);
// monthlyOrderCreditPDF
Route::get('/monthlyOrderCreditPDF',[PDFController::class, 'monthlyOrderCreditPDF']);

// userCreditSearchPDF
Route::get('/userCreditSearchPDF',[PDFController::class, 'userCreditSearchPDF']);


// adminCreditSearchPDF
Route::get('/adminCreditSearchPDF',[PDFController::class, 'adminCreditSearchPDF']);



// todayAdminCreditPDF
Route::get('/todayAdminCreditPDF',[PDFController::class, 'todayAdminCreditPDF']);
// monthlyOrderAdminCreditPDF
Route::get('/monthlyOrderAdminCreditPDF',[PDFController::class, 'monthlyOrderAdminCreditPDF']);
// orderDetailPDF
Route::get('/orderDetailPDF/{id}',[PDFController::class, 'orderDetailPDF']);



