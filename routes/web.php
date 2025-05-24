<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

//Rutas

Route::get('/', function () {
    return view('principal');
})->name('home');

Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store'])->name('register');

//
Route::get('/muro', [PostController::class, 'index'])->name('posts.index');
