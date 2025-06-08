<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthCheck;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('students', StudentsController::class);

Route::get('/students-list', [StudentsController::class, 'index']);
Route::get('/students/create', [StudentsController::class, 'create'])->name('students.create');
Route::post('/students', [StudentsController::class, 'store'])->name('students.store');
Route::get('/students', [StudentsController::class, 'index'])->name('students.index');

Route::get('/', function () {
    return redirect()->route('auth.index');
});

// Auth ;
Route::get('/login', [AuthController::class, 'login']);
Route::post('/user-login', [AuthController::class, 'userLogin'])->name('auth.login');

Route::get('/register', [AuthController::class, 'indexRegister'])->name('auth.register');
Route::post('/user-register', [AuthController::class, 'userRegister'])->name('auth.userRegister');

Route::middleware([AuthCheck::class])->group(function () {
    Route::get('/students', [StudentsController::class, 'index'])->name('std.index');
    Route::post('/create-student', [StudentsController::class, 'newStudent'])->name('std.create');

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});