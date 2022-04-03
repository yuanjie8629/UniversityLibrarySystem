<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

// USER
// LOGIN
//Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
//Route::post('/login', function(){
//    return redirect()->route('login');
//})->name('login');
// REGISTER
//Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
//Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'registerUser'])->name('register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// get csrf token
Route::get('/csrf', function () {
    return response()->json(csrf_token());
});

Route::get('/admin-home', function () {
    return response()->json(['message' => 'Admin Home']);
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

