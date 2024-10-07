<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BolimController;
use App\Http\Controllers\MuxirController;
use App\Http\Controllers\ArxivController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NaryadBController;

//naryad_blanka_show

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

/* Naryadlar Blankalar */
Route::get('/naryad_blanka', [NaryadBController::class, 'naryad_blanka'])->name('naryad_blanka');
Route::post('/naryad_blanka_delete', [NaryadBController::class, 'naryad_blanka_delete'])->name('naryad_blanka_delete');
Route::get('/naryad_blanka_korzinka', [NaryadBController::class, 'naryad_blanka_korzinka'])->name('naryad_blanka_korzinka');
Route::post('/naryad_blanka_korzinka_add', [NaryadBController::class, 'naryad_blanka_korzinka_add'])->name('naryad_blanka_korzinka_add');
Route::post('/naryad_blanka_korzinka_delete', [NaryadBController::class, 'naryad_blanka_korzinka_delete'])->name('naryad_blanka_korzinka_delete');
Route::post('/naryad_blanka_korzinka_delete_all', [NaryadBController::class, 'naryad_blanka_korzinka_delete_all'])->name('naryad_blanka_korzinka_delete_all');
Route::get('/naryad_blanka_NEW', [NaryadBController::class, 'naryad_blanka_NEW'])->name('naryad_blanka_NEW');
Route::post('/naryad_blanka_NEW_story', [NaryadBController::class, 'naryad_blanka_NEW_story'])->name('naryad_blanka_NEW_story');
Route::get('/naryad_blanka_NEW_TWO', [NaryadBController::class, 'naryad_blanka_NEW_TWO'])->name('naryad_blanka_NEW_TWO');
Route::post('/naryad_blanka_NEW_TWO_story', [NaryadBController::class, 'naryad_blanka_NEW_TWO_story'])->name('naryad_blanka_NEW_TWO_story');
Route::post('/naryad_blanka_faktura_pdf', [NaryadBController::class, 'naryad_blanka_faktura_pdf'])->name('naryad_blanka_faktura_pdf');
Route::post('/naryad_blanka_faktura_delete', [NaryadBController::class, 'naryad_blanka_faktura_delete'])->name('naryad_blanka_faktura_delete');
Route::get('/naryad_blanka_show/{id}', [NaryadBController::class, 'naryad_blanka_show'])->name('naryad_blanka_show');  // Xisob Faktura uchun show page
Route::post('/naryad_blanka_faktura_upload', [NaryadBController::class, 'naryad_blanka_faktura_upload'])->name('naryad_blanka_faktura_upload');
Route::post('/naryad_blanka_faktura_delete_pdf', [NaryadBController::class, 'naryad_blanka_faktura_delete_pdf'])->name('naryad_blanka_faktura_delete_pdf');

/*   Muxirlar */
Route::get('/qidruv_muxir', [SearchController::class, 'qidruv_muxir'])->name('qidruv_muxir');
Route::get('/qidruv_naryad_blanka', [SearchController::class, 'qidruv_naryad_blanka'])->name('qidruv_naryad_blanka');
Route::get('/qidruv_simkarta', [SearchController::class, 'qidruv_simkarta'])->name('qidruv_simkarta');
Route::get('/qidruv_naryadlar', [SearchController::class, 'qidruv_naryadlar'])->name('qidruv_naryadlar');

/*   Muxirlar */
Route::get('/arxiv_muxir', [ArxivController::class, 'arxiv_muxir'])->name('arxiv_muxir');
Route::get('/arxiv_naryad_blanka', [ArxivController::class, 'arxiv_naryad_blanka'])->name('arxiv_naryad_blanka');
Route::get('/arxiv_simkarta', [ArxivController::class, 'arxiv_simkarta'])->name('arxiv_simkarta');
Route::get('/arxiv_naryadlar', [ArxivController::class, 'arxiv_naryadlar'])->name('arxiv_naryadlar');

/*   Muxirlar */
Route::get('/muxirs', [MuxirController::class, 'muxirs'])->name('muxirs');
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
Route::post('/faktura_delete_faktura', [MuxirController::class, 'faktura_delete_faktura'])->name('faktura_delete_faktura');

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