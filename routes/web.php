<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StartupController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', fn() => view('home'))->name('home');
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login',    [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',    [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile',     [ProfileController::class, 'update'])->name('profile.update');

    // Corporate only
    Route::middleware('role:corporate')->group(function () {
        Route::get('/startups',           [StartupController::class, 'index'])->name('startups.index');
        Route::get('/startups/{id}',      [StartupController::class, 'show'])->name('startups.show');
        Route::post('/interests/{startupId}', [InterestController::class, 'store'])->name('interests.store');
    });

    // Startup only
    Route::middleware('role:startup')->group(function () {
        Route::patch('/interests/{id}', [InterestController::class, 'update'])->name('interests.update');
    });
});
