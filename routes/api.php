<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Routing\RouteGroup;

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::get('/posts2/{id}', [PostController::class, 'show2']);

Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware('pemilik-postingan');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('pemilik-postingan');
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('buku',[BukuController::class,'index']);
// Route::get('buku/{id}',[BukuController::class,'show']);
// Route::post('buku',[BukuController::class,'store']);
// Route::put('buku/{id}',[BukuController::class,'update']);
// Route::delete('buku/{id}',[BukuController::class,'destroy']);

Route::apiResource('buku', BukuController::class)->middleware('checkHost');
