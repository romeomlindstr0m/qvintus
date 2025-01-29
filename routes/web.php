<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.process')->middleware('throttle:authentication');

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

Route::redirect('/', '/home');
Route::get('/home', function() {
    return view('home');
})->name('home');