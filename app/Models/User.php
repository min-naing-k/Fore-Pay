<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $guarded = ['id'];

  protected $hidden = [
    'password',
    'remember_token',
    'pivot',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function wallet()
  {
    return $this->hasOne(Wallet::class, 'user_id', 'id');
  }

  public function getNameAttribute($name)
  {
    return ucwords($name);
  }

  public function setPasswordAttribute($password)
  {
    $this->attributes['password'] = bcrypt($password);
  }

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? false, function ($query, $search) {
      $query->orWhere('name', 'like', "%$search%")
        ->orWhere('email', 'like', "%$search%")
        ->orWhere('phone', 'like', "%$search%");
    });
  }

  public function profileImage()
  {
    if ($this->image) {
      return asset('storage/' . $this->image);
    }

    return null;
  }

  public function coverImage()
  {
    if ($this->cover_image) {
      return asset('storage/' . $this->cover_image);
    }

    return null;
  }
}
