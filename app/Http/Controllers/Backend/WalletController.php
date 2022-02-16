<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Wallet;

class WalletController extends Controller
{
  public function index()
  {
    return view('backend.wallet.index');
  }

  public function showAllWallets()
  {
    if (request()->ajax()) {
      $limit = request('limit', 5);
      $field = request('field', 'created_at');
      $direction = request('direction', null);
      $wallets = Wallet::with('user')
        ->select(['wallets.*', 'users.name as user_name, users.email as user_email, users.phone as user_phone, users.image as user_image'])
        ->join('users', 'wallets.user_id', '=', 'users.id')
        ->filter(request(['search']))
        ->orderBy($field, $direction ?? 'desc')
        ->paginate($limit)
        ->withQueryString();
      return view('components.backend.wallet-table', compact('wallets', 'field', 'direction'))->render();
    }

    return back();
  }
}
