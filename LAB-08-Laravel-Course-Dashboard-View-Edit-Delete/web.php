
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;

// Redirect the home page to login.
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes for users who are not logged in.
Route::middleware('guest')->group(function () {

    // Show the registration page.
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    // Show the login page.
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    // Save a new user account.
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    // Check the login information.
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

// Routes for users who are logged in.
Route::middleware('auth')->group(function () {

    // Log out the current user.
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Open the student dashboard.
    Route::get('/dashboard', [CourseController::class, 'index'])
        ->name('dashboard');

    // Save a new course.
    Route::post('/courses', [CourseController::class, 'store'])
        ->name('courses.store');

    // Open a course for editing.
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])
        ->whereNumber('course')
        ->name('courses.edit');

    // Display course details.
    Route::get('/courses/{course}', [CourseController::class, 'show'])
        ->whereNumber('course')
        ->name('courses.show');

    // Update an existing course.
    Route::put('/courses/{course}', [CourseController::class, 'update'])
        ->whereNumber('course')
        ->name('courses.update');

    // Delete a course.
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])
        ->whereNumber('course')
        ->name('courses.destroy');
});
