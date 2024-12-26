<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserAccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\InvestmentController;


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
    Route::resource('investment', InvestmentController::class);
    Route::resource('investor', InvestorController::class);
    Route::resource('asset', ProgramController::class);
    Route::resource('loan', ProgramController::class);
    Route::get('user-access', [UserAccessController::class, 'index'])->name('user-access.index');
    Route::post('user-access', [UserAccessController::class, 'store'])->name('user-access.store');

    Route::put('/investors/update/{investor}', [InvestorController::class, 'update'])->name('investors.update');
    Route::get('/investors/create', [InvestorController::class, 'create'])->name('investors.create');
    Route::get('/investors/edit/{investor}', [InvestorController::class, 'edit'])->name('investors.edit');
    Route::get('/investors/index', [InvestorController::class, 'index'])->name('investors.index');
    Route::delete('/investors/destroy/{investor}', [InvestorController::class, 'destroy'])->name('investors.destroy');
    Route::post('/investors/store', [InvestorController::class, 'store'])->name('investors.store');

    Route::get('/investments/create', [InvestmentController::class, 'create'])->name('investments.create');
    Route::get('/investments/edit', [InvestmentController::class, 'edit'])->name('investments.edit');
    Route::get('/investments/destroy', [InvestmentController::class, 'destroy'])->name('investments.destroy');
});

