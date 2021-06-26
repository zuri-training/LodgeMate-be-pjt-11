<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Admin\Auth as AuthAdmin;
use App\Http\Controllers\Admin;

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
    return view('welcome');
});

Auth::routes([ 'verify' => true ]);
//Routes to views
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/terms_of_use', function(){
    return view ('terms_of_use');
});
Route::get('/terms_of_use', function(){
    return view ('terms_of_use');
});
Route::get('/privacy', function(){
    return view ('privacy');
});
Route::get('/policy', function(){
    return view ('policy');
});
Route::get('/contact_us', function(){
    return view ('contact_us');
});
Route::get('/about_us', function(){
    return view ('about_us');
});
Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


 // route to all controllers inside the Admin/
Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {

    // route to all controllers inside the Admin/Auth/
    Route::namespace('Auth')->group(function(){

        Route::get('/login',[AuthAdmin\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login',[AuthAdmin\LoginController::class, 'login'])->name('login');
        Route::post('/logout',[AuthAdmin\LoginController::class, 'logout'])->name('logout');

        //Register Routes
        // Route::get('/register','RegisterController@showRegistrationForm')->name('register');
        // Route::post('/register','RegisterController@register');

        //Forgot Password Routes
        Route::get('/password/reset',[AuthAdmin\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/email',[AuthAdmin\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}',[AuthAdmin\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset',[AuthAdmin\ResetPasswordController::class, 'reset'])->name('password.update');

        // Email Verification Route(s)
        Route::get('email/verify',[AuthAdmin\VerificationController::class, 'show'])->name('verification.notice');
        Route::get('email/verify/{id}',[AuthAdmin\VerificationController::class, 'verify'])->name('verification.verify');
        Route::post('email/resend',[AuthAdmin\VerificationController::class, 'resend'])->name('verification.resend');

    });


    Route::get('/', [Admin\HomeController::class, 'index'])->name('home')->middleware('guard.verified:admin,admin.verification.notice');

});

Route::resource('hostel', Controllers\HostelController::class);
