<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CoinTransferController;
use App\Http\Controllers\RewardController;

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Login and Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Password Reset
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Registration
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::post('/register/student', [RegisterController::class, 'registerStudent'])->name('register.student.post');  

Route::get('/register/teacher', [RegisterController::class, 'showTeacherForm'])->name('register.teacher.form');
Route::post('/register/teacher', [RegisterController::class, 'registerTeacher'])->name('register.teacher');

Route::get('/register/partner', [RegisterController::class, 'showPartnerForm'])->name('register.partner.form');
Route::post('/register/partner', [RegisterController::class, 'registerPartner'])->name('register.partner');

// Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Coin Transfer
Route::middleware(['auth'])->group(function () {
    Route::get('/coins/transfer', [CoinTransferController::class, 'create'])->name('coins.transfer.create');
    Route::post('/coins/transfer', [CoinTransferController::class, 'store'])->name('coins.transfer.store');
});

// Rewards
Route::middleware(['auth'])->group(function () {
    Route::get('/rewards', [RewardController::class, 'index'])->name('rewards');
    Route::get('/rewards/create', [RewardController::class, 'create'])->name('rewards.create');
    Route::post('/rewards/create', [RewardController::class, 'store'])->name('rewards.store');
    Route::get('/rewards/{reward}', [RewardController::class, 'show'])->name('rewards.show');
    Route::post('/rewards/{reward}/redeem', [RewardController::class, 'redeem'])->name('rewards.redeem');
});

