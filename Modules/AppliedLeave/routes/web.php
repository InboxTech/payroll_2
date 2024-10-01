<?php

use Illuminate\Support\Facades\Route;
use Modules\AppliedLeave\Http\Controllers\AppliedLeaveController;

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
    Route::resource('appliedleave', AppliedLeaveController::class);
    Route::post('/appliedleave/delete', [AppliedLeaveController::class, 'destroy'])->name('appliedleave.delete');
    Route::get('appliedleave/{id}/editleave', [AppliedLeaveController:: class, 'editleave'])->name('appliedleave.editleave');
    Route::put('appliedleave/{leaveapply}/updateleave', [AppliedLeaveController:: class, 'updateleave'])->name('appliedleave.updateleave');
    Route::post('getNumberofLeaveInThisMonth', [AppliedLeaveController::class, 'getNumberofLeavesinThisMonth'])->name('appliedleave.getNumberofLeavesinThisMonth');
});