<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\BookController;
use Illuminate\Support\Facades\Gate;

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

//Admin navigation
Route::get('/manage-books', [App\Http\Controllers\BookManagementController::class, 'index'])->middleware("can:isAdmin")->name('book-management');
Route::get('/manage-users', [App\Http\Controllers\UserManagementController::class, 'index'])->middleware("can:isAdmin")->name('user-management');




// book
Route::post('book', [App\Http\Controllers\BookController::class, 'create']);
Route::get('books', [App\Http\Controllers\BookController::class, 'readAll']);
Route::get('book/{id}', [App\Http\Controllers\BookController::class, 'readOne']);
Route::put('book/{id}', [App\Http\Controllers\BookController::class, 'update']);
Route::delete('book/{id}', [App\Http\Controllers\BookController::class, 'delete']);



