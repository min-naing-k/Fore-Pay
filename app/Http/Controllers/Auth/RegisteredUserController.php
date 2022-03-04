<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UUIDGenerate;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\GeneralNotification;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'phone' => ['required', 'numeric', 'digits-between:9,11', 'unique:users,phone'],
      'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    DB::beginTransaction();
    try {
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => $request->password,
      ]);

      Wallet::create([
        'user_id' => $user->id,
        'account_number' => UUIDGenerate::accountNumber(),
      ]);

      DB::commit();
      event(new Registered($user));
      Auth::login($user);
      $title = 'Welcome ' . $user->name;
      $message = 'Thanks for using our application.';
      $sourceable_id = $user->id;
      $sourceable_type = User::class;
      $web_link = url('/');
      $user->notify(new GeneralNotification($title, $message, $sourceable_id, $sourceable_type, $web_link));
      return redirect(RouteServiceProvider::HOME);
    } catch (Exception $e) {
      DB::rollBack();
      return redirect()->route('register')->with('fail', 'Oops! try again!');
    }
  }
}
