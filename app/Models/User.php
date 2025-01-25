<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
  use HasApiTokens, HasFactory, Notifiable;
  protected $fillable = ['email', 'password', 'role', 'ban_status', 'deleted_at'];
  protected $hidden = ['password'];

  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'deleted_at' => 'datetime',
    'ban_status' => 'boolean',
  ];

  public function studentProfile(): HasOne
  {
    return $this->hasOne(StudentProfile::class);
  }
}
