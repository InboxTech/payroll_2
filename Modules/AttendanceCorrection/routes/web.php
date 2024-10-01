<?php

use Illuminate\Support\Facades\Route;
use Modules\AttendanceCorrection\Http\Controllers\AttendanceCorrectionController;

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
    Route::resource('attendancecorrection', AttendanceCorrectionController::class)->names('attendancecorrection');
    Route::get('attendancecorrection/{id}/correction', [AttendanceCorrectionController::class, 'correction'])->name('attendancecorrection.correction');
    Route::post('attendance-list', [AttendanceCorrectionController::class, 'attendancelist'])->name('attendancecorrection.attendancelist');
});
