<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', 'Login\SignInController@showFrom')->name('login');
    Route::post('/authenticate', 'Login\SignInController@authenticateUser')->name('signin');

    Route::get('/logout', 'Logout\LogoutController@logout')->name('logout');

    Route::get('/signup', 'SignUp\SignUpController@showFrom')->name('signup');
    Route::post('/register', 'SignUp\SignUpController@register')->name('register');

    Route::get('/forgot-password', 'ForgotPassword\ForgotPasswordController@showFrom')->name('forgot-password');
    Route::get('/forgot-password-otp-generate', 'ForgotPassword\ForgotPasswordController@otpGenerate')->name('forgot-password-otp-generate');
    Route::get('/forgot-password-otp-verify', 'ForgotPassword\ForgotPasswordController@otpVerify')->name('forgot-password-otp-verify');
    Route::post('/reset-password', 'ForgotPassword\ForgotPasswordController@resetPassword')->name('reset-password');

    Route::get('/change-password', 'ChangePassword\ChangePasswordController@showFrom')->name('change-password');
    Route::post('/change-password-update', 'ChangePassword\ChangePasswordController@updatePassword')->name('change-password-update');
});


Route::group(['prefix' => 'admin', 'middleware' => ['isAuth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
