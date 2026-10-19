<?php

// Use the controller that handles registration, login, and logout.
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// When someone opens the home page, send them to the login page.
Route::redirect('/', '/login');

// These pages are for users who have not logged in yet.
Route::middleware('guest')->group(function () {

    // Open the registration page.
    Route::view('/register', 'auth.register')->name('register');

    // Send registration form data to the controller.
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    // Open the login page.
    Route::view('/login', 'auth.login')->name('login');

    // Check the login details submitted by the user.
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

// Only logged-in users can access these routes.
Route::middleware('auth')->group(function () {

    // Show the dashboard page.
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Send the logout request to the controller.
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
