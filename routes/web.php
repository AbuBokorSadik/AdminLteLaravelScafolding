<?php

use App\Http\Controllers\Auth\ChangePassword\ChangePasswordController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\AgentPanel\Dashboard\AgentDashboardController;
use App\Http\Controllers\MerchantPanel\Dashboard\MerchantDashboardController;
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
});

Route::group(['middleware' => ['isAuth', 'isActive']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/change-password', [ChangePasswordController::class, 'showFrom'])->name('change-password');
    Route::post('/change-password-update', [ChangePasswordController::class, 'updatePassword'])->name('change-password-update');

    Route::resource('profiles', Profile\ProfileController::class);

    Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin']], function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('categories', Category\CategoryController::class);

        Route::resource('products', Product\ProductController::class);

        Route::resource('agents', Agent\AgentController::class);

        Route::resource('merchants', Merchant\MerchantController::class);
    });

    Route::group(['prefix' => 'agent', 'middleware' => ['isAgent']], function () {
        Route::get('/', [AgentDashboardController::class, 'index'])->name('agent.dashboard');
    });

    Route::group(['prefix' => 'merchant', 'middleware' => ['isMerchant']], function () {
        Route::get('/', [MerchantDashboardController::class, 'index'])->name('merchant.dashboard');

        Route::resource('orders', MerchantPanel\Order\OrderController::class);
    });
});