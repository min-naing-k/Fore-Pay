<?php

namespace App\Helpers;

use App\Models\Transaction;
use App\Models\Wallet;

class UUIDGenerate
{
  public static function accountNumber()
  {
    $number = mt_rand(1000000000000000, 9999999999999999);

    if (Wallet::where('account_number', $number)->exists()) {
      self::accountNumber();
    }

    return $number;
  }

  public static function ref_no()
  {
    $number = mt_rand(1000000000000000, 9999999999999999);

    if (Transaction::where('ref_no', $number)->exists()) {
      self::ref_no();
    }

    return $number;
  }

  public static function trx_id()
  {
    $number = mt_rand(1000000000000000, 9999999999999999);

    if (Transaction::where('trx_id', $number)->exists()) {
      self::trx_id();
    }

    return $number;
  }
}
