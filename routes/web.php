<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FakturaController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\BolimController;

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/tarqatildi', [HomeController::class, 'tarqatildi'])->name('tarqatildi');
Route::get('/home_create', [HomeController::class, 'create'])->name('home_create');
Route::post('/home_story', [HomeController::class, 'story'])->name('home_story');
Route::post('/home_story_pedding', [HomeController::class, 'story_pedding'])->name('home_story_pedding');
Route::get('/korzinka', [HomeController::class, 'korzinka'])->name('korzinka');
Route::get('/korzinka/bolim/{coato}', [HomeController::class, 'korzinkaBolimCoato'])->name('korzinka_bolim_coato');
Route::post('/korzinka_delete', [HomeController::class, 'korzinka_delete'])->name('korzinka_delete');
Route::post('/korzinka_faktura', [HomeController::class, 'korzinka_faktura'])->name('korzinka_faktura');
Route::get('/korzinka_show/{id}', [HomeController::class, 'korzinka_show'])->name('korzinka_show');
Route::post('/korzinka_faktura_image', [HomeController::class, 'korzinka_faktura_image'])->name('korzinka_faktura_image');


Route::get('/faktura', [FakturaController::class, 'index'])->name('faktura');
Route::get('/faktura_show/{id}', [FakturaController::class, 'faktura_show'])->name('faktura_show');
Route::post('/faktura_image', [FakturaController::class, 'faktura_image'])->name('faktura_image');

Route::get('/bolim', [BolimController::class, 'index'])->name('bolim');
Route::get('/create_bolim', [BolimController::class, 'create'])->name('create_bolim');
Route::post('/create_bolim/story', [BolimController::class, 'story'])->name('create_bolim_story');
Route::get('/bolim/{id}', [BolimController::class, 'show'])->name('bolim_show');
Route::post('/create_bolim/update', [BolimController::class, 'update'])->name('create_bolim_update');
Route::post('/create_bolim/create/hodim', [BolimController::class, 'hodimStory'])->name('create_bolim_create_hodim');
Route::post('/create_bolim/delete/hodim', [BolimController::class, 'hodimDelete'])->name('create_bolim_delete_hodim');


Route::get('/chart', [ChartController::class, 'index'])->name('chart');



Route::get('/xisobot', [ChartController::class, 'xisobot'])->name('xisobot');
