<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\ProjectController;

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
    Route::resource('project', ProjectController::class);
    Route::post('/project/delete', [ProjectController::class, 'destroy'])->name('project.delete');
    Route::post('project_change_status', [ProjectController::class, 'change_status'])->name('project.change_status');
    Route::post('geEmployeeList', [ProjectController::class, 'getEmployeeList'])->name('project.getEmployeeList');
    Route::get('removedproject', [ProjectController::class, 'removedproject'])->name('project.removedproject');
    Route::post('project_restore', [ProjectController::class, 'restoreproject'])->name('project.restoreproject');
});
