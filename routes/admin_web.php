<?php

use App\Http\Controllers\Auth\AdminSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
  Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AdminSessionController::class, 'create'])->name('admin.login');
    Route::post('login', [AdminSessionController::class, 'store'])->name('admin.login.store');
  });

  Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
      return 'Hello Admin ' . auth()->guard('admin')->user()->name;
    });
  });
});
