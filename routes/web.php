<?php

use Illuminate\Support\Facades\Route;

// all routes should be inside here except login
Route::middleware(['auth'])->group(function () {

    // admin permission
    Route::middleware(['can:isAdmin'])->group(function () {

        // user model
        // Router
        Route::get('/manage-users', [App\Http\Controllers\UserManagementController::class, 'index'])->name('user-management');
        // REST api
        Route::get('users', [App\Http\Controllers\UserController::class, 'readAll']);
        Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
        Route::put('user/{id}', [App\Http\Controllers\UserController::class, 'update']);
        Route::delete('user/{id}', [App\Http\Controllers\UserController::class, 'delete']);
        Route::post('reset-password/{id}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('reset-password');

        // book model
        // Router
        Route::get('/manage-books', [App\Http\Controllers\BookManagementController::class, 'index'])->name('book-management');
        // REST api
        Route::post('book', [App\Http\Controllers\BookController::class, 'create']);
        Route::put('book/{id}', [App\Http\Controllers\BookController::class, 'update']);
        Route::delete('book/{id}', [App\Http\Controllers\BookController::class, 'delete']);

        // borrow model
        // Router
        Route::get('/manage-borrows', [App\Http\Controllers\BorrowManagementController::class, 'index'])->name('borrow-management');
        Route::get('/return-book', [App\Http\Controllers\BorrowManagementController::class, 'returnBook'])->name('return-book');
        // REST api
        Route::post('borrow', [App\Http\Controllers\BorrowController::class, 'create']);
        Route::get('borrows', [App\Http\Controllers\BorrowController::class, 'readAll']);
        Route::get('borrow/{id}', [App\Http\Controllers\BorrowController::class, 'readOne']);
        Route::put('borrow/{id}', [App\Http\Controllers\BorrowController::class, 'update']);
        Route::delete('borrow/{id}', [App\Http\Controllers\BorrowController::class, 'delete']);
    });

    Route::middleware(['can:isNotAdmin'])->group(function () {
        // user model
        // Router
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/change-password', [App\Http\Controllers\auth\ChangePasswordController::class, 'index'])->name('change-password');
        // REST api
        Route::post('change-password/{id}', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword'])->name('change-password');
    });

    // public permission
    // book model
    // REST api
    Route::get('books', [App\Http\Controllers\BookController::class, 'readAll']);
    Route::get('book/{id}', [App\Http\Controllers\BookController::class, 'readOne']);

    // user model
    // Router
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

// special case for login function
Route::middleware(['auth.login'])->group(function () {
    // Router
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    // REST api
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
});
