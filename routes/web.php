<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('home', [HomeController::class, 'index']);
Route::resource('/posts', \App\Http\Controllers\PostController::class);

Route::get('buku', [BukuController::class, 'index']);
Route::post('buku', [BukuController::class, 'store']);
Route::get('buku/{id}', [BukuController::class, 'edit']);
Route::put('buku/{id}', [BukuController::class, 'update']);
Route::delete('buku/{id}', [BukuController::class, 'destroy']);
