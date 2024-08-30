<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

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

Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::resource('user', UserController::class);
    Route::post('/user/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('user_change_status', [UserController::class, 'change_status'])->name('user.change_status');
    Route::post('user_check_duplication', [UserController::class, 'check_duplication'])->name('user_check_duplication');
    Route::get('assign-leaves', [UserController::class, 'assignleaves'])->name('user.assignleaves');
    Route::get('offer-letter/{userId}', [UserController::class, 'generateOfferLetter']);
    Route::get('user/{userId}/leave-history', [UserController::class, 'leavehistory'])->name('user.leavehistory');
    Route::get('user/{userId}/salary-history', [UserController::class, 'salaryhistory'])->name('user.salaryhistory');
    Route::get('user/{userId}/view-letter', [UserController::class, 'viewletter'])->name('user.viewletter');
});
