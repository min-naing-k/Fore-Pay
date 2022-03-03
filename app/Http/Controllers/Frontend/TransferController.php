<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UUIDGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransfer;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\GeneralNotification;
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

  public function transferHash()
  {
    $str = request('phone') . request('amount') . request('description', null);
    $hash_value = hash_hmac('sha256', $str, env('TRANSFER_KEY'));
    return response()->json([
      'status' => 'success',
      'data' => $hash_value,
    ]);
  }

  public function store(StoreTransfer $request)
  {
    $phone = $request->phone;
    $amount = $request->amount;
    $description = $request->description ?? null;
    $hash_value_original = $request->hash_value;
    $hash_value_new = hash_hmac('sha256', $phone . $amount . $description, env('TRANSFER_KEY'));

    if ($hash_value_original !== $hash_value_new) {
      return redirect()->route('transfer')->with('error', 'Invalid Data!');
    }

    $user = User::firstWhere('phone', $request->phone);
    $request->session()->forget(['status', 'data']);

    if (!$user) {
      return redirect()->route('transfer')->with('error', 'Invalid Data!');
    }

    session(['transfer-data' => [
      'hash_value' => $hash_value_original,
      'user' => $user,
      'amount' => $amount,
      'description' => $description,
    ]]);

    return redirect()->route('transfer.confirm');
  }

  public function transferConfirm()
  {
    $data = null;
    if (session()->has('transfer-data')) {
      $data = session('transfer-data');
    } else {
      return redirect()->route('home');
    }

    $hash_value = $data['hash_value'];
    $user = $data['user'];
    $amount = $data['amount'];
    $description = $data['description'];

    return view('frontend.confirm-transaction', compact('hash_value', 'user', 'amount', 'description'));
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
    $description = $request->description ?? null;
    $str = $phone . $amount . $description;
    $from_user = User::with('wallet')->findOrFail(request('id'));
    $to_user = User::with('wallet')->firstWhere('phone', $phone);
    $hash_value_original = $request->hash_value;
    $hash_value_new = hash_hmac('sha256', $str, env('TRANSFER_KEY'));
    $request->session()->forget(['status', 'data']);

    if ($hash_value_original !== $hash_value_new) {
      return redirect()->route('transfer')->with('error', 'Invalid Data!');
    }

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
      if ($description) {
        $from_user_transaction['description'] = $description;
        $to_user_transaction['description'] = $description;
      }
      $from_user_transaction_record = Transaction::create($from_user_transaction);
      $to_user_transaction_record = Transaction::create($to_user_transaction);

      DB::commit();
      $title = 'E-money Transfer';
      $message = 'You transfer ' . number_format($amount) . 'MMK to ' . $to_user->name;
      $sourceable_id = $from_user->id;
      $sourceable_type = Transaction::class;
      $web_link = url('transactions/' . $from_user_transaction_record->trx_id);
      $from_user->notify((new GeneralNotification($title, $message, $sourceable_id, $sourceable_type, $web_link))->afterCommit());

      $title = 'E-money Receive';
      $message = 'You receive ' . number_format($amount) . 'MMK from ' . $from_user->name;
      $sourceable_id = $to_user->id;
      $sourceable_type = Transaction::class;
      $web_link = url('transactions/' . $to_user_transaction_record->trx_id);
      $to_user->notify((new GeneralNotification($title, $message, $sourceable_id, $sourceable_type, $web_link))->afterCommit());

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
    session()->forget('transfer-data');

    if (!$data) {
      return redirect()->route('home');
    }

    $receive_user = $data['receive_user'];
    $amount = $data['amount'];

    return view('frontend.success-transaction', compact('receive_user', 'amount'));
  }
}
