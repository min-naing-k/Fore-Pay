<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\TransactionController;
use App\Http\Controllers\Frontend\TransferController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
  Route::get('/', [PageController::class, 'home'])->name('home');

  Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
  Route::get('profile/edit', [ProfileController::class, 'profileEdit'])->name('profile.edit');
  Route::patch('profile/edit/{user_id}', [ProfileController::class, 'profileUpdate'])->name('profile.edit.update');
  Route::get('edit-password', [ProfileController::class, 'editPassword'])->name('password.edit');
  Route::post('update-password/{user_id}', [ProfileController::class, 'updatePassword'])->name('password.update');

  Route::get('find-user', [TransferController::class, 'findUser']);
  Route::get('transfer', [TransferController::class, 'transfer'])->name('transfer');
  Route::post('transfer', [TransferController::class, 'store'])->name('transfer.store');
  Route::post('check-password', [TransferController::class, 'checkPassword']);
  Route::post('send-transaction', [TransferController::class, 'sendTransaction'])->name('transfer.send');
  Route::get('success-transaction', [TransferController::class, 'successTransaction'])->name('transfer-successful');

  Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
});
