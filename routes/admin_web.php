<?php

use App\Http\Controllers\Auth\AdminSessionController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WalletController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
  Route::middleware(['guest:admin', 'auth:admin'])->group(function () {
    Route::get('login', [AdminSessionController::class, 'create'])->name('login')->withoutMiddleware('auth:admin');
    Route::post('login', [AdminSessionController::class, 'store'])->name('login.store')->withoutMiddleware('auth:admin');
    Route::get('logout', [AdminSessionController::class, 'destroy'])->withoutMiddleware('guest:admin');
  });
  Route::middleware('auth:admin')->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');

    Route::resource('admin-user', AdminUserController::class);
    Route::delete('selected-admin-user/{selected_admins_id}', [AdminUserController::class, 'destroySelected']);
    Route::get('admin-user-table', [AdminUserController::class, 'showAllAdmins']);

    Route::resource('user', UserController::class);
    Route::delete('selected-user/{selected_users_id}', [UserController::class, 'destroySelected']);
    Route::get('user-table', [UserController::class, 'showAllAdmins']);

    Route::get('wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('wallet-table', [WalletController::class, 'showAllWallets']);
  });
});
