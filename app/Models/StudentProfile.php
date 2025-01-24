<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentProfile extends Model
{
  public function peminjaman(): HasMany
  {
    return $this->hasMany(Peminjaman::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
