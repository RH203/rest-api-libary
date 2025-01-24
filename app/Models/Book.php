<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{

  protected $fillable = ['image', 'title', 'author', 'description', 'stock', 'publisher_id', 'deleted_at'];
  public function publisher(): BelongsTo
  {
    return $this->belongsTo(Publisher::class);
  }

  public function peminjaman(): HasMany
  {
    return $this->hasMany(Peminjaman::class);
  }

  public function genre(): BelongsToMany
  {
    return $this->belongsToMany(Genre::class);
  }
}
