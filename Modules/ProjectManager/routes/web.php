<?php

use Illuminate\Support\Facades\Route;
use Modules\ProjectManager\Http\Controllers\ProjectManagerController;

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

Route::group([], function () {
    Route::resource('projectmanager', ProjectManagerController::class)->names('projectmanager');
});

Route::prefix('admin')->middleware(['auth', 'checkuserstatus'])->group(function(){
    Route::resource('projectmanager', ProjectManagerController::class);
    Route::post('/projectmanager/delete', [ProjectManagerController::class, 'destroy'])->name('projectmanager.delete');
    Route::get('projectmanager/{id}/editleave', [ProjectManagerController:: class, 'editleave'])->name('projectmanager.editleave');
    Route::put('projectmanager/{leaveapply}/updateleave', [ProjectManagerController:: class, 'updateleave'])->name('projectmanager.updateleave');
});