<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSessionController extends Controller
{
  public function create()
  {
    return view('auth.admin_login');
  }

  public function store(AdminLoginRequest $request)
  {
    $request->authenticate();

    $admin = auth()->guard('admin')->user();
    $admin->ip = $request->ip();
    $admin->user_agent = $request->server('HTTP_USER_AGENT');
    $admin->update();

    $request->session()->regenerate();

    return redirect('/admin');
  }

  public function destroy(Request $request)
  {
    if ($request->ajax()) {
      Auth::guard('admin')->logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return response()->json(['message' => 'admin logout successfully!']);
    }
    return back();
  }
}
