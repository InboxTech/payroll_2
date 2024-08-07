<?php

use Illuminate\Support\Facades\Route;
use Modules\Designation\Http\Controllers\DesignationController;

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
    Route::post('designation_change_status', [DesignationController::class, 'change_status'])->name('designation.change_status');
    Route::resource('designation', DesignationController::class)->names('designation');
});
