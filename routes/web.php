<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FakturaController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\BolimController;

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/faktura', [FakturaController::class, 'index'])->name('faktura');


Route::get('/bolim', [BolimController::class, 'index'])->name('bolim');
Route::get('/create_bolim', [BolimController::class, 'create'])->name('create_bolim');
Route::post('/create_bolim/story', [BolimController::class, 'story'])->name('create_bolim_story');
Route::get('/bolim/{id}', [BolimController::class, 'show'])->name('bolim_show');
Route::post('/create_bolim/update', [BolimController::class, 'update'])->name('create_bolim_update');
Route::post('/create_bolim/create/hodim', [BolimController::class, 'hodimStory'])->name('create_bolim_create_hodim');
Route::post('/create_bolim/delete/hodim', [BolimController::class, 'hodimDelete'])->name('create_bolim_delete_hodim');


Route::get('/chart', [ChartController::class, 'index'])->name('chart');
