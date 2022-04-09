<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// book
Route::post('book', [App\Http\Controllers\BookController::class, 'create']);
Route::get('books', [App\Http\Controllers\BookController::class, 'readAll']);
Route::get('book/{id}', [App\Http\Controllers\BookController::class, 'readOne']);
Route::put('book/{id}', [App\Http\Controllers\BookController::class, 'update']);
Route::delete('book/{id}', [App\Http\Controllers\BookController::class, 'delete']);

//borrow
Route::post('borrow', [App\Http\Controllers\BorrowController::class, 'create']);
Route::get('borrows', [App\Http\Controllers\BorrowController::class, 'readAll']);
Route::get('borrow/{id}', [App\Http\Controllers\BorrowController::class, 'readOne']);
Route::put('borrow/{id}', [App\Http\Controllers\BorrowController::class, 'update']);
Route::delete('borrow/{id}', [App\Http\Controllers\BorrowController::class, 'delete']);
