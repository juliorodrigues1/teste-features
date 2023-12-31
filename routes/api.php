<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', [\App\Http\Controllers\Api\BookController::class, 'index']);
Route::get('books/{id}', [\App\Http\Controllers\Api\BookController::class, 'show']);
Route::post('books', [\App\Http\Controllers\Api\BookController::class, 'store']);
Route::put('books/{id}', [\App\Http\Controllers\Api\BookController::class, 'update']);
