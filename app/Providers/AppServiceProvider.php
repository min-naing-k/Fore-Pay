<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    View::composer('*', function ($view) {
      $unread_notifications = 0;
      $auth_user_name = null;
      $auth_user_email = null;
      if (Auth::guard('web')->check()) {
        $unread_notifications = auth()->user()->unreadnotifications->count();
        $auth_user_name = auth()->user()->name;
        $auth_user_email = auth()->user()->email;
      }
      $view->with([
        'unread_notifications' => $unread_notifications,
        'auth_user_name' => $auth_user_name,
        'auth_user_email' => $auth_user_email,
      ]);
    });
  }
}
