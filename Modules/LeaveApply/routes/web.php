<?php

use Illuminate\Support\Facades\Route;
use Modules\LeaveApply\Http\Controllers\LeaveApplyController;

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

Route::prefix('admin')->middleware(['auth', 'checkuserstatus'])->group(function(){
    Route::resource('leaveapply', LeaveApplyController::class);
    Route::post('/leaveapply/delete', [LeaveApplyController::class, 'destroy'])->name('leaveapply.delete');
    Route::post('leaveapply_change_status', [LeaveApplyController::class, 'change_status'])->name('leaveapply.change_status');
});
