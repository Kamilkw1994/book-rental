<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ClientController;


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

Route::get('books', [BookController::class, 'index']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::post('books/{id}/rent', [BookController::class, 'rent']);
Route::put('books/{id}/return', [BookController::class, 'return']);

Route::get('clients', [ClientController::class, 'index']);
Route::get('clients/{id}', [ClientController::class, 'show']);
Route::post('clients', [ClientController::class, 'store']);
Route::delete('clients/{id}', [ClientController::class, 'destroy']);
