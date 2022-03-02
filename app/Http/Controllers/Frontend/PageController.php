<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;

class PageController extends Controller
{
  public function home()
  {
    return view('frontend.home');
  }

  public function wallet()
  {
    $user = auth()->user();
    $account_number = $user->wallet->account_number;
    $amount = $user->wallet->amount;
    $user_name = $user->name;
    $transactions = Transaction::where('user_id', $user->id)
      ->latest('created_at')
      ->take(5)
      ->get();
    return view('frontend.wallet', compact('account_number', 'amount', 'user_name', 'transactions'));
  }

  public function qrcodeShow()
  {
    $user_name = auth()->user()->name;
    $phone = auth()->user()->phone;
    return view('frontend.qr-code', compact('user_name', 'phone'));
  }

  public function scanAndPay()
  {
    return view('frontend.scan-and-pay');
  }

  public function redirestToTransfer()
  {
    $phone = request('phone');

    if (!$phone) {
      return redirect()->route('home');
    }

    if (!User::where('phone', $phone)->where('phone', '!=', auth()->user()->phone)->exists()) {
      return redirect()->route('scan-and-pay')->with('error', 'Invalid Qr Code');
    }

    return view('frontend.transfer', compact('phone'));
  }
}
