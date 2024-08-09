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
    Route::get('/salary/month-list/{user}', [SalaryController::class, 'monthlist'])->name('salary.monthlist');
    Route::post('calculateAllDaysWithSalary', [SalaryController::class, 'calculateAllDaysWithSalary'])->name('salary.calculateAllDaysWithSalary');
    Route::get('generate-slip/{id}', [SalaryController::class, 'generateslip'])->name('salary.generateslip');
    Route::get('employee-salary', [SalaryController::class, 'employeesalary'])->name('salary.employeesalary');
});