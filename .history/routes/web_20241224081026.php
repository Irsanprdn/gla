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
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LoanController;


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('', [DashboardController::class,'index'])->name('dashboard');    
    Route::resource('users', UserController::class);
    Route::resource('programs', ProgramController::class);
    Route::get('user-access', [UserAccessController::class, 'index'])->name('user-access.index');
    Route::post('user-access', [UserAccessController::class, 'store'])->name('user-access.store');
    Route::resource('income', IncomeController::class);
    Route::resource('expense', ExpenseController::class);
    Route::resource('bank_account', ProgramController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('attendance', ProgramController::class);    
    Route::resource('investments', InvestmentController::class);
    Route::resource('investors', InvestorController::class);
    Route::resource('bank_account', BankAccountController::class);
    Route::resource('asset', AssetController::class);    
    Route::resource('loan', LoanController::class);    
});

