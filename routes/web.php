<?php

use Illuminate\Support\Facades\Route;

@include('./auth.php');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login', ['name' => "IQ9999999", 'age' => [20, 21, 22, 23]]);
});

Route::get('/register', function () {
    return view('auth.register');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// get csrf token
Route::get('/csrf', function () {
    return response()->json(csrf_token());
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

