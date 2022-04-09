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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// get csrf token
Route::get('/csrf', function () {
    return response()->json(csrf_token());
});

//Admin navigation
Route::get('/manage-books', [App\Http\Controllers\BookManagementController::class, 'index'])->middleware("can:isAdmin")->name('book-management');
Route::get('/manage-users', [App\Http\Controllers\UserManagementController::class, 'index'])->middleware("can:isAdmin")->name('user-management');

// user
Auth::routes();
