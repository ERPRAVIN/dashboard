<?php
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\LogOut;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\SignUpController;
use App\Http\Middleware\CheckUser;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\CustomClasses\CollectionPaginate;


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

Route::get('/', function () {
    return view('login_page');
    
});

Route::get('/signup_page', function () {
    return view('signup_page');
});
Route::get('/forgot_password', function () {
    return view('forgot_pass');
});
Route::get('login', function () {
    return view('login_page');
});
Route::get('/ResetPasswordUsingMail', function () {
    return view('email_reset_page');
});
Route::POST('/register', [SignUpController::class, 'store']);
Route::POST('/forgot_password_post', [ForgotPasswordController::class, 'submitForgetPassword']);
Route::POST('/ResetPasswordUsingMail', [ForgotPasswordController::class, 'resetPasswordUsingMail']);

Route::middleware([CheckUser::class])->group(function () {

    //Route to add  product by calling store method of ProductController

    Route::POST('/product.store', [ProductController::class, 'store']);

    //Route to delete Product by id using destroy method of ProductController

    Route::get('/delete/{id}', [ProductController::class, 'destroy', 'id']);

    //Route to update Product by id using edit method of ProductController

    Route::get('/update/{id}', [ProductController::class, 'edit', 'id']);

    Route::post('/product.update', [ProductController::class, 'update']);

    Route::get('/add_product', function () {
        return view('add_product');
    });

    Route::get('/reset', function () {
        return view('reset_pass');
    });
    Route::get('dashboard', function () {
        return view('dashboard')->with('productArr', Product::paginate(5));
    })->name('dashboard');
    Route::POST('/ResetPassword', [ResetPassword::class, 'update']);
    //logout route
    Route::get('/logout', [LogOut::class, 'userLogOut']);

    Route::get('/generatepdf/{id}', [PDFController::class, 'generatePDF', 'id']);
    Route::get('/downloadpdf/{id}', [PDFController::class, 'downloadPDF', 'id']);
});

    Route::POST('/userLogin', [LogInController::class, 'userLogin']);

Route::get('custom-log', function () {

    Log::channel('mycustomlog')->info('This is testing for custom log');

    dd('done');

});
Route::get('/myjob', [ForgotPasswordController::class, 'sendEmail']);
Route::POST('/search', [ProductController::class, 'index']);
Route::get('/search/{page?}',[ProductController::class, 'index']);

