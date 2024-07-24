<?php

use Illuminate\Support\Facades\Route;
use Modules\Salary\Http\Controllers\SalaryController;

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
    Route::resource('salary', SalaryController::class);
    Route::get('/salary/delete', [SalaryController::class, 'destroy'])->name('salary.delete');
});
