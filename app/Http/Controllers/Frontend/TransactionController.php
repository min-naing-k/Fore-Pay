<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
  public function index()
  {
    return view('frontend.transactions.index');
  }
}
