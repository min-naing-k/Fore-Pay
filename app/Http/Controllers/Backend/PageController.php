<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
  public function dashboard()
  {
    return view('backend.dashboard');
  }
}
