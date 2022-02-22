<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UUIDGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransfer;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TransferController extends Controller
{

  public function transfer()
  {
    return view('frontend.transfer');
  }

  public function findUser()
  {
    if (!request('phone')) {
      return null;
    }

    $search = request('phone');
    $search_length = strlen($search);
    if ($search_length >= 9) {
      $user = User::firstWhere('phone', $search);
      if (!$user) {
        return response()->json([
          'status' => 'fail',
          'message' => 'There is no user account',
        ]);
      }

      if ($user->phone == auth()->user()->phone) {
        return response()->json([
          'status' => 'fail',
          'message' => "You can't transfer money to your account",
        ]);
      }

      return response()->json([
        'status' => 'success',
        'message' => $user->name,
      ]);
    }

    return null;
  }

  public function store(StoreTransfer $request)
  {
    if ($request->amount > auth()->user()->wallet->amount) {
      return back()->withErrors(['amount' => "You don't have sufficence balance!"])->withInput();
    }

    $user = User::firstWhere('phone', $request->phone);
    $amount = $request->amount;
    $description = $request->description ?? null;
    $request->session()->forget(['status', 'data']);

    return view('frontend.confirm-transaction', compact('user', 'amount', 'description'));
  }

  public function checkPassword()
  {
    $current_password = request('password');
    if (!$current_password) {
      return response()->json([
        'status' => 'fail',
        'message' => "Password is empty!",
      ]);
    }

    $user = User::find(request('id'));
    if (!$user) {
      return response()->json([
        'status' => 'fail',
        'message' => "Password is wrong!",
      ]);
    }

    if (!Hash::check($current_password, $user->password)) {
      return response()->json([
        'status' => 'fail',
        'message' => "Password is wrong!",
      ]);
    }

    return response()->json([
      'status' => 'success',
    ]);
  }

  public function sendTransaction(StoreTransfer $request)
  {
    $phone = $request->phone;
    $amount = $request->amount;
    $from_user = User::with('wallet')->findOrFail(request('id'));
    $to_user = User::with('wallet')->firstWhere('phone', $phone);
    $request->session()->forget(['status', 'data']);

    if (!$from_user->wallet || !$to_user->wallet) {
      return redirect()->route('transfer')->with('error', 'Something went wrong with wallet!');
    }

    DB::beginTransaction();
    try {
      $from_user->wallet->decrement('amount', $amount);
      $to_user->wallet->increment('amount', $amount);

      $ref_no = UUIDGenerate::ref_no();
      $from_user_transaction = [
        'ref_no' => $ref_no,
        'trx_id' => UUIDGenerate::trx_id(),
        'user_id' => $from_user->id,
        'source_id' => $to_user->id,
        'type' => 2,
        'amount' => $amount,
      ];
      $to_user_transaction = [
        'ref_no' => $ref_no,
        'trx_id' => UUIDGenerate::trx_id(),
        'user_id' => $to_user->id,
        'source_id' => $from_user->id,
        'type' => 1,
        'amount' => $amount,
      ];
      if ($request->description) {
        $from_user_transaction['description'] = $request->description;
        $to_user_transaction['description'] = $request->description;
      }
      Transaction::create($from_user_transaction);
      Transaction::create($to_user_transaction);

      DB::commit();
      request()->session()->flash('transfer-successful', [
        'receive_user' => $to_user->name,
        'amount' => $amount,
      ]);
      return redirect()->route('transfer-successful');
    } catch (Exception $e) {
      DB::rollBack();
      return redirect()->route('transfer')->with('error', 'Something went wrong with transfer!' . $e->getMessage());
    }
  }

  public function successTransaction()
  {
    $data = session('transfer-successful');

    if (!$data) {
      return redirect()->route('home');
    }

    $receive_user = $data['receive_user'];
    $amount = $data['amount'];

    return view('frontend.success-transaction', compact('receive_user', 'amount'));
  }
}
