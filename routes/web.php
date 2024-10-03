<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;



Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');



/*   ADMINISTRATOR  */

Route::get('/admin_user', [UserController::class, 'admin_user'])->name('admin_user');
Route::post('/admin_create', [UserController::class, 'admin_create'])->name('admin_create');
Route::get('/admin_user_show/{id}', [UserController::class, 'admin_user_show'])->name('admin_user_show');
Route::post('/admin_update', [UserController::class, 'admin_update'])->name('admin_update');
Route::post('/admin_update_password', [UserController::class, 'admin_update_password'])->name('admin_update_password');
Route::get('/admin_profel', [UserController::class, 'admin_profel'])->name('admin_profel');
Route::post('/admin_profel_update_password', [UserController::class, 'admin_profel_update_password'])->name('admin_profel_update_password');