<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ATMController;
use App\Http\Controllers\AuthController;


// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');
    Route::get('/registration-success', [AuthController::class, 'registrationSuccess'])->name('registration.success');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
    Route::post('/logout', [AuthController::class, 'userLogout'])->name('auth.logout');
});

// User Dashboard (for account management)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'userDashboard'])->name('user.dashboard');
});

// ATM Routes
Route::prefix('atm')->group(function () {
    Route::get('/', [ATMController::class, 'welcome'])->name('atm.welcome');
    Route::post('/authenticate', [ATMController::class, 'authenticate'])->name('atm.authenticate');
    
    // Protected ATM routes
    Route::middleware(['atm.auth'])->group(function () {
        Route::get('/dashboard', [ATMController::class, 'dashboard'])->name('atm.dashboard');
        Route::post('/logout', [ATMController::class, 'logout'])->name('atm.logout');
    });
});