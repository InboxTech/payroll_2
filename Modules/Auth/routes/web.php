<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

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

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login-submit', [AuthController::class, 'login_submit'])->name('login_submit');
    Route::match(['get', 'post'], 'forgot-password', [AuthController::class, 'forgot_password'])->name('forgot_password');
    Route::get('reset-password/{token}', [AuthController::class, 'reset_password'])->name('reset_password');
    Route::post('reset-submit-password/{token}', [AuthController::class, 'reset_submit_password'])->name('reset_submit_password');
    Route::get('back', [AuthController::class, 'route_back'])->name('back');

    Route::middleware(['auth'])->group(function (){
        Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::match(['get', 'post'], 'profile', [AuthController::class, 'profile'])->name('profile');
        Route::match(['get', 'post'], 'change-password', [AuthController::class, 'change_password'])->name('change_password');
    });
});
