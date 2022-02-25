<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function source()
  {
    return $this->belongsTo(User::class, 'source_id', 'id');
  }
}
