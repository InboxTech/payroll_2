<?php

use Illuminate\Support\Facades\Route;
use Modules\HolidayLeave\Http\Controllers\HolidayLeaveController;

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
    Route::resource('holidayleave', HolidayLeaveController::class);
    Route::get('holidayleave/delete/{id}', [HolidayLeaveController::class, 'destroy'])->name('holidayleave.delete');
    Route::post('getnumberofholiday', [HolidayLeaveController::class, 'getnumberofholiday'])->name('salary.getnumberofholiday');
    Route::get('previous-leave', [HolidayLeaveController::class, 'previousleave'])->name('holidayleave.previousleave');
});
