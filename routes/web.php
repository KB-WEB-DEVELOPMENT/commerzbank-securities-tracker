<?php

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TransactionController;

use Illuminate\Foundation\Application;

use Inertia\Inertia;

Route::get('/', function () {
		return Inertia::render('Welcome', [
			'canLogin' => Route::has('login'),
			'canRegister' => Route::has('register'),
			'laravelVersion' => Application::VERSION,
			'phpVersion' => PHP_VERSION,
		]);				
})->name('homepage.indexPage');

Route::get('/dashboard', [DashboardController::class, 'index'])
       ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/accounts', [AccountController::class, 'index'])
       ->middleware(['auth', 'verified'])->name('account.show-accounts');
	
Route::get('/accounts/{accountId}/portfolio', [PortfolioController::class, 'index'])
       ->middleware(['auth', 'verified'])->name('portfolio.show-portfolio');
	
Route::get('/accounts/{accountId}/portfolio/positions/{positionId}', [PortfolioController::class, 'position'])
       ->middleware(['auth', 'verified'])->name('portfolio.position-details');
	
Route::get('/accounts/{accountId}/transactions', [TransactionController::class, 'transactions'])
       ->middleware(['auth', 'verified'])->name('transaction.show-transactions');
	
Route::get('/accounts/{accountId}/transactions/accrued-interest-desc', [TransactionController::class, 'sortAccruedInterest'])
       ->middleware(['auth', 'verified'])->name('transaction.show-sort-accruedInterest');
	
Route::get('/accounts/{accountId}/transactions/type-count-desc', [TransactionController::class, 'sortTypeCount'])
       ->middleware(['auth', 'verified'])->name('transaction.show-sort-typeCount');
	
Route::get('/accounts/{accountId}/transactions/week', [TransactionController::class, 'sortWeek'])
    ->middleware(['auth', 'verified'])->name('transaction.show-sort-week');
	
Route::get('/accounts/{accountId}/transactions/month', [TransactionController::class, 'sortMonth'])
    ->middleware(['auth', 'verified'])->name('transaction.show-sort-month');
	
Route::get('/accounts/{accountId}/transactions/year', [TransactionController::class, 'sortYear'])
    ->middleware(['auth', 'verified'])->name('transaction.show-sort-year');
	
Route::get('/accounts/{accountId}/transactions/{transactionId}', [TransactionController::class, 'transaction'])
    ->middleware(['auth', 'verified'])->name('transaction.transaction-details');
