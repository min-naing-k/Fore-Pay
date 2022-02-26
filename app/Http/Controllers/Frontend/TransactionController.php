<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{
  public function index()
  {
    $query = Transaction::with('source')
      ->where('user_id', auth()->id())
      ->whereBetween('created_at', [
        Carbon::parse(now())->subMonth(1)->format('Y-m-d'),
        Carbon::parse(now())->format('Y-m-d'),
      ]);

    if (request('type')) {
      $query->where('type', request('type'));
    }

    if (request('start-date') && request('end-date')) {
      $start_date = request('start-date');
      $end_date = request('end-date');
      $query->whereBetween('created_at', [
        $start_date,
        Carbon::parse($end_date)->endOfDay(),
      ]);
    }

    $transactions = $query->orderByDesc('created_at')
      ->paginate(10)
      ->withQueryString()
      ->groupBy(function ($transaction) {
        return Carbon::parse($transaction->created_at)->format('F');
      });

    if (request()->ajax()) {
      if (!$transactions->count()) {
        return response()->json([
          'html' => null,
        ]);
      } else {
        $view = view('frontend.transactions.transactions-data', compact('transactions'))->render();
        return response()->json([
          'html' => $view,
        ]);
      }
    }

    return view('frontend.transactions.index', compact('transactions'));
  }
}
