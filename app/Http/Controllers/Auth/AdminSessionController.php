<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSessionController extends Controller
{
  public function create()
  {
    return view('auth.admin_login');
  }

  public function store(LoginRequest $request)
  {
    $request->authenticate('admin');

    $request->session()->regenerate();

    return redirect('/admin/dashboard');
  }

  public function destroy(Request $request)
  {
    Auth::guard('admin')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
  }
}
