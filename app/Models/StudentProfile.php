<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentProfile extends Model
{
  use SoftDeletes;

  protected $fillable = ['image', 'full_name', 'phone_number', 'address', 'gender',  'date_of_birth', 'user_id', 'ban_status'];

  protected $casts = [
    'date_of_birth' => 'date',
    'ban_status' => 'boolean',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'deleted_at' => 'datetime',
  ];
  public function peminjaman(): HasMany
  {
    return $this->hasMany(Peminjaman::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
