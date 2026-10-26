
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::view('/login', 'auth.login')->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

Route::middleware('auth')->group(function () {
    // Display dashboard and registered books
    Route::get('/dashboard', [BookController::class, 'index'])
        ->name('dashboard');

    // Register a new book
    Route::post('/books', [BookController::class, 'store'])
        ->name('books.store');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
