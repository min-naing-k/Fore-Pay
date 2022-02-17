<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::middleware('auth')->group(function () {
  Route::get('/', [PageController::class, 'home'])->name('home');

  Route::get('profile', [PageController::class, 'profile'])->name('profile');
  Route::get('profile/edit', [PageController::class, 'profileEdit'])->name('profile.edit');
  Route::patch('profile/edit/{user_id}', [PageController::class, 'profileUpdate'])->name('profile.edit.update');
});
