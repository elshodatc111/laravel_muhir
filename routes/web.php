<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BolimController;
use App\Http\Controllers\MuxirController;



Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*   Muxirlar */
Route::get('/muxir', [MuxirController::class, 'muxir'])->name('muxir');
Route::post('/muxir_delete', [MuxirController::class, 'muxir_delete'])->name('muxir_delete');
Route::post('/muxir_add_korzinka', [MuxirController::class, 'muxir_add_korzinka'])->name('muxir_add_korzinka');
Route::get('/muxir_korzinka', [MuxirController::class, 'muxir_korzinka'])->name('muxir_korzinka');
Route::post('/muxir_korzinka_muxir_del', [MuxirController::class, 'muxir_korzinka_muxir_del'])->name('muxir_korzinka_muxir_del');
Route::post('/muxir_korzinka_muxir_del_all', [MuxirController::class, 'muxir_korzinka_muxir_del_all'])->name('muxir_korzinka_muxir_del_all');
Route::get('/muxir_new', [MuxirController::class, 'muxir_new'])->name('muxir_new');
Route::post('/muxir_new_create', [MuxirController::class, 'muxir_new_create'])->name('muxir_new_create');
Route::get('/muxir_new_two', [MuxirController::class, 'muxir_new_two'])->name('muxir_new_two');
Route::post('/muxir_new_create_two', [MuxirController::class, 'muxir_new_create_two'])->name('muxir_new_create_two');
Route::get('/korzinka/bolim/{coato}', [MuxirController::class, 'korzinkaBolimCoato'])->name('korzinka_bolim_coato');  
Route::post('/muxir_faktura_pdf', [MuxirController::class, 'muxir_faktura_pdf'])->name('muxir_faktura_pdf');
Route::get('/muxir_faktura_show/{id}', [MuxirController::class, 'muxir_faktura_show'])->name('muxir_faktura_show');  // Xisob Faktura uchun show page
Route::post('/faktura_upload_muxir', [MuxirController::class, 'faktura_upload_muxir'])->name('faktura_upload_muxir'); // Xisob fakturani yuklash
Route::post('/faktura_delete_muxir', [MuxirController::class, 'faktura_delete_muxir'])->name('faktura_delete_muxir');

/*   BO'LIMLAR */
Route::get('/bolim', [BolimController::class, 'bolim'])->name('bolim');
Route::post('/bolim_create', [BolimController::class, 'bolim_create'])->name('bolim_create');
Route::post('/bolim_update', [BolimController::class, 'bolim_update'])->name('bolim_update');
Route::post('/bolim_hodim_create', [BolimController::class, 'bolim_hodim_create'])->name('bolim_hodim_create');
Route::post('/bolim_hodim_lock', [BolimController::class, 'bolim_hodim_lock'])->name('bolim_hodim_lock');
Route::get('/bolim_show/{id}', [BolimController::class, 'bolim_show'])->name('bolim_show');

/*   ADMINISTRATOR */
Route::get('/admin_user', [UserController::class, 'admin_user'])->name('admin_user');
Route::post('/admin_create', [UserController::class, 'admin_create'])->name('admin_create');
Route::get('/admin_user_show/{id}', [UserController::class, 'admin_user_show'])->name('admin_user_show');
Route::post('/admin_update', [UserController::class, 'admin_update'])->name('admin_update');
Route::post('/admin_update_password', [UserController::class, 'admin_update_password'])->name('admin_update_password');
Route::get('/admin_profel', [UserController::class, 'admin_profel'])->name('admin_profel');
Route::post('/admin_profel_update_password', [UserController::class, 'admin_profel_update_password'])->name('admin_profel_update_password');