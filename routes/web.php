<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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


Route::group(['middleware' => ['auth:1', 'throttle:60,1']], function(){

        Route::group(['middleware'=> 'verified'], function(){
            //Category
            Route::post('/add_category', [AdminController::class, 'add_category']);
            Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

            //Subcategory
            Route::post('/add_subcategory/{id}', [AdminController::class, 'add_subcategory']);
            Route::get('/delete_subcategory/{id}', [AdminController::class, 'delete_subcategory']);

            //Products
            Route::post('/add_products', [AdminController::class, 'add_products']);
            Route::get('/delete_products/{id}', [AdminController::class, 'delete_products']);
            Route::get('/view_edit_products/{id}', [AdminController::class, 'view_edit_products']);
            Route::post('/edit_products/{id}', [AdminController::class, 'edit_products']);

            //Order
            Route::get('/delivered/{id}', [AdminController::class, 'delivered']);
            Route::get('/cancel_order/{id}', [AdminController::class, 'cancel_order']);

            //Logs
            Route::get('logs', [LogViewerController::class, 'index']);
        });
        //Category
        Route::get('/admin', [AdminController::class, 'view_admin_page']);
        Route::get('/category', [AdminController::class, 'view_categroy']);

        //Subcategory
        Route::get('/subcategory/{id}', [AdminController::class, 'view_subcategory']);

       
        //Products
        Route::get('/view_show_products', [AdminController::class, 'view_show_products']);
        Route::get('/view_add_products', [AdminController::class, 'view_add_products']);

        //Oder
        Route::get('/show_orders', [AdminController::class, 'show_orders']);
        // Route::get('/search_order', [AdminController::class, 'search_order']);
        Route::get('/print_cancelled_orders', [AdminController::class, 'print_cancelled_orders']);
    
        //Email
        Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);
        Route::post('/send_email_notification/{id}', [AdminController::class, 'send_email_notification']);
        Route::get('/send_email/{id}', [AdminController::class, 'send_email']);

        //Subscribe
        Route::get('/view_email_all', [AdminController::class, 'view_email_all']);
        Route::post('/email_all', [AdminController::class, 'email_all']);
        Route::get('/delete_subscriber/{id}', [AdminController::class, 'delete_subscriber']);

        //Contact
        Route::get('/all_messages', [AdminController::class, 'all_messages']);
        Route::get('/delete_message/{id}', [AdminController::class, 'delete_message']);
        Route::post('/send_message', [AdminController::class, 'send_message']);
        Route::get('/admin/messages', function () {
            $contacts = DB::table('contacts')->orderBy('created_at', 'desc')->take(5)->get();
            return view('admin-page.messages', ['contacts' => $contacts]);
        });

        //Account Settings Admin
        Route::get('/view_upload_photo', [AdminController::class, 'view_upload_photo']);
        Route::post('/upload_photo', [AdminController::class, 'upload_photo']);

        //Admin change password
        Route::get('/view_change_password', [AdminController::class, 'view_change_password']);
        Route::post('/change_password', [AdminController::class, 'change_password']);

        //Admin account settings
        Route::get('/view_account_settings', [AdminController::class, 'view_account_settings']);
        Route::post('/account_settings', [AdminController::class, 'account_settings']);
        Route::match(['get', 'post'],'/view_search_products', [AdminController::class, 'view_search_products']);
});

Route::group(['middleware' => ['auth:0', 'throttle:60,1']], function(){

    Route::group(['middleware'=> 'verified'], function(){
        //Cart
        Route::post('/add_cart/{id}', [UserController::class, 'add_cart']);

        //Orders
        Route::match(['get', 'post'],'/order', [UserController::class, 'order']);
    });

    //Cart
    Route::get('/show_cart', [UserController::class, 'show_cart']);
    Route::get('/delete_cart/{id}', [UserController::class, 'delete_cart']);
    Route::post('/stripe', [UserController::class, 'stripe_post'])->name('stripe');

    //Orders
    Route::get('/view_orders', [UserController::class, 'view_orders'] );

    //Comments and Replies
    Route::post('/add_comment', [UserController::class, 'add_comment']);
    Route::post('/add_reply', [UserController::class, 'add_reply']);
    Route::get('/delete_comment/{id}', [UserController::class, 'delete_comment'] );
    Route::get('/delete_reply/{id}', [UserController::class, 'delete_reply'] );
    
    //User account settings
    Route::get('/view_account_profile', [UserController::class, 'view_account_profile']);        
    Route::post('/account_profile', [UserController::class, 'account_profile']);

    //User Change Password
    Route::get('/view_user_password', [UserController::class, 'view_change_password']);
    Route::post('/change_user_password', [UserController::class, 'change_password']);

});


//Login and Register
Route::get('/', [UserController::class, 'view_home_page'])->middleware('throttle:60,1')->name('home');
Route::get('/register', [LoginController::class, 'view_register_page']);
Route::post('/createUser', [LoginController::class, 'createUser'])->middleware('throttle:60,1')->name('createUser');
Route::get('/login', [LoginController::class, 'view_login_page'])->name('loginUser');
Route::post('/authenticateUser', [LoginController::class, 'authenticateUser'])->middleware('throttle:60,1')->name('authenticateUser');
Route::get('/forgotPassword', [LoginController::class, 'view_forgot_password'])->name('forgotPassword');
Route::post('/sendReset', [LoginController::class, 'send_reset_password'])->name('sendReset');
Route::get('/reset_password/{verification_code}', [LoginController::class, 'reset_password']);
Route::post('/confirm_new_password', [LoginController::class, 'confirm_new_password'])->name('confirmNewPassword');
Route::get('/verify_email/{verification_code}', [LoginController::class, 'verify_email']);
Route::get('/privacy_policy', [LoginController::class, 'privacy_policy']);
Route::get('/terms_of_use', [LoginController::class, 'terms_of_use']);
Route::post('/logout', [LoginController::class, 'logout']);

//Product
Route::get('/product_details/{id}', [UserController::class, 'product_details']);
// Route::get('/search_products', [UserController::class, 'search_products']);
// Route::get('/products_search', [UserController::class, 'products_search']);

Route::get('/view_products/{idCat}/{idSub}', [UserController::class, 'view_products_subcategory'])->middleware('throttle:60,1');
Route::get('/view_products/{id}', [UserController::class, 'view_products_category'])->middleware('throttle:60,1');
Route::get('/view_products', [UserController::class, 'view_products'])->middleware('throttle:60,1');

//Subsrcibe and email
Route::post('/add_email', [UserController::class, 'add_email']);

//contact page
Route::get('/view_contact', [UserController::class, 'view_contact']);
Route::post('/send_issue', [UserController::class, 'send_issue']);

//About us
Route::get('/view_about', [UserController::class, 'view_about']);


Route::get('/e', function(){
    return view('errors.user_not_found');
});




