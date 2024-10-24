<?php

use Illuminate\Support\Facades\Route;
use Modules\Hr\Http\Controllers\HrController;

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
    Route::resource('hr', HrController::class);
    Route::post('/hr/delete', [HrController::class, 'destroy'])->name('hr.delete');
    Route::get('hr/{id}/editleave', [HrController:: class, 'editleave'])->name('hr.editleave');
    Route::put('hr/{leaveapply}/updateleave', [HrController:: class, 'updateleave'])->name('hr.updateleave');
    Route::post('getNumberofLeaveInThisMonth', [HrController::class, 'getNumberofLeavesinThisMonth'])->name('hr.getNumberofLeavesinThisMonth');
});
