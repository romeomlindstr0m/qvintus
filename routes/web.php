<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Livewire\UserSearch;

use App\Http\Controllers\UserController;

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.process')->middleware('throttle:authentication');

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/users', UserSearch::class)->name('users.index');
    Route::post('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
});

Route::redirect('/', '/home');
Route::get('/home', function() {
    return view('home');
})->name('home');