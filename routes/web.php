<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function() {
    return view('index');
})->name('index')->middleware('auth');

Route::get('/register', [AuthenticationController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register.process');

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.process');