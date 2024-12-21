<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserAccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('', [DashboardController::class,'index'])->name('dashboard');    
    Route::resource('users', UserController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('income', IncomeController::class);
    Route::resource('expense', ExpenseController::class);
    Route::resource('bank_account', ProgramController::class);
    Route::resource('employee', ProgramController::class);
    Route::resource('attendance', ProgramController::class);
    Route::resource('investment', ProgramController::class);
    Route::resource('investor', ProgramController::class);
    Route::resource('asset', ProgramController::class);
    Route::resource('loan', ProgramController::class);
    Route::get('user-access', [UserAccessController::class, 'index'])->name('user-access.index');
    Route::post('user-access', [UserAccessController::class, 'store'])->name('user-access.store');
});

