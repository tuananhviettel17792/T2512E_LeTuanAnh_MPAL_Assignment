<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankAccountController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bank-accounts/create', [BankAccountController::class, 'create'])->name('bank-accounts.create');
Route::post('/bank-accounts', [BankAccountController::class, 'store'])->name('bank-accounts.store');

Route::get('/bank-accounts', [BankAccountController::class, 'index'])->name('bank-accounts.index');
