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

// all routes should be inside here
Route::middleware(['auth'])->group(function () {
    Route::get('/testing', function () {
        return view('testing');
    })->name('testing');

    // admin permission
    Route::middleware(['can:isAdmin'])->group(function () {
        // user model 
        Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
        Route::post('reset-password/{id}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('reset-password');

        // book model
        Route::post('book', [App\Http\Controllers\BookController::class, 'create']);
        Route::put('book/{id}', [App\Http\Controllers\BookController::class, 'update']);
        Route::delete('book/{id}', [App\Http\Controllers\BookController::class, 'delete']);

        //borrow
        Route::post('borrow', [App\Http\Controllers\BorrowController::class, 'create']);
        Route::get('borrows', [App\Http\Controllers\BorrowController::class, 'readAll']);
        Route::get('borrow/{id}', [App\Http\Controllers\BorrowController::class, 'readOne']);
        Route::put('borrow/{id}', [App\Http\Controllers\BorrowController::class, 'update']);
        Route::delete('borrow/{id}', [App\Http\Controllers\BorrowController::class, 'delete']);
    });

    // public permission
    // user model
    // change password
    Route::post('change-password/{id}', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword'])->name('change-password');

    // book model
    Route::get('books', [App\Http\Controllers\BookController::class, 'readAll']);
    Route::get('book/{id}', [App\Http\Controllers\BookController::class, 'readOne']);
});

// special case for login function
Route::middleware(['auth.login'])->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
});


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
