<?php

use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\TransactionController;
use App\Http\Controllers\Frontend\TransferController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'prevent_back_history'])->group(function () {
  Route::get('/', [PageController::class, 'home'])->name('home');
  Route::get('wallet', [PageController::class, 'wallet'])->name('wallet');

  Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
  Route::get('profile/edit', [ProfileController::class, 'profileEdit'])->name('profile.edit');
  Route::patch('profile/edit/{user_id}', [ProfileController::class, 'profileUpdate'])->name('profile.edit.update');
  Route::get('edit-password', [ProfileController::class, 'editPassword'])->name('password.edit');
  Route::post('update-password/{user_id}', [ProfileController::class, 'updatePassword'])->name('password.change');

  Route::get('find-user', [TransferController::class, 'findUser']);
  Route::get('transfer', [TransferController::class, 'transfer'])->name('transfer');
  Route::post('transfer', [TransferController::class, 'store'])->name('transfer.store');
  Route::get('transfer-hash', [TransferController::class, 'transferHash']);
  Route::get('transfer-confirm', [TransferController::class, 'transferConfirm'])->name('transfer.confirm');
  Route::post('check-password', [TransferController::class, 'checkPassword']);
  Route::post('send-transaction', [TransferController::class, 'sendTransaction'])->name('transfer.send');
  Route::get('success-transaction', [TransferController::class, 'successTransaction'])->name('transfer-successful');

  Route::resource('transactions', TransactionController::class)->only(['index', 'show']);

  Route::get('qr-code', [PageController::class, 'qrcodeShow'])->name('qr-code');
  Route::get('scan-and-pay', [PageController::class, 'scanAndPay'])->name('scan-and-pay');
  Route::post('scan-and-pay', [PageController::class, 'redirestToTransfer'])->name('scan-and-pay.redirect-to-transfer');

  Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
  Route::get('notification/{id}', [NotificationController::class, 'show'])->name('notification.show');
  Route::get('mark-as-read', [NotificationController::class, 'markAsRead']);
  Route::get('mark-as-unread', [NotificationController::class, 'markAsUnRead']);
  Route::delete('notification/{id}', [NotificationController::class, 'destroy']);
  Route::get('mark-all-as-read', [NotificationController::class, 'markAllAsRead']);
  Route::get('delete-all-notifications', [NotificationController::class, 'deleteAllNotifications']);
});
