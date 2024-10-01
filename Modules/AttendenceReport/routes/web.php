<?php

use Illuminate\Support\Facades\Route;
use Modules\AttendenceReport\Http\Controllers\AttendenceReportController;

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
    Route::resource('attendencereport', AttendenceReportController::class);
    Route::get('attendencereport/{id}/report', [AttendenceReportController::class, 'report'])->name('attendencereport.report');
    Route::post('report_details', [AttendenceReportController::class, 'report_details'])->name('attendencereport.report_details');
});