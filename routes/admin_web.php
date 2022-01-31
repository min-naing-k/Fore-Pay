<?php

use App\Http\Controllers\Auth\AdminSessionController;
use App\Http\Controllers\Backend\PageController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
  Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AdminSessionController::class, 'create'])->name('login');
    Route::post('login', [AdminSessionController::class, 'store'])->name('login.store');
  });

  Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
  });
});
