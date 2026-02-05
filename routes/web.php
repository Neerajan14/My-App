<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect root to students index
Route::get('/', function () {
    return redirect()->route('students.index');
});

// Authentication routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes for authenticated users
Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        $students = \App\Models\Student::count();
        $teachers = \App\Models\Teacher::count();
        return view('dashboard', compact('students', 'teachers'));
    })->name('dashboard');

    // Student CRUD routes
    Route::resource('students', StudentController::class);

    // Teacher CRUD + reports
    Route::get('teachers/report', [TeacherController::class, 'report'])->name('teachers.report');
    Route::get('teachers/export', [TeacherController::class, 'export'])->name('teachers.export');
    Route::resource('teachers', TeacherController::class);
});
