<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\AdminSessionController;
use App\Http\Controllers\Backend\PageController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
  Route::middleware(['guest:admin', 'auth:admin'])->group(function () {
    Route::get('login', [AdminSessionController::class, 'create'])->name('login')->withoutMiddleware('auth:admin');
    Route::post('login', [AdminSessionController::class, 'store'])->name('login.store')->withoutMiddleware('auth:admin');
    Route::post('logout', [AdminSessionController::class, 'destroy'])->withoutMiddleware('guest:admin');
  });

  Route::middleware('auth:admin')->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');

    Route::resource('admin-user', AdminUserController::class);
  });
});
