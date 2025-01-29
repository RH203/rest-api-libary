<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
  use SoftDeletes;

  protected $fillable = ['image', 'title', 'author', 'description', 'stock', 'publisher_id', 'deleted_at'];
  public function publisher(): BelongsTo
  {
    return $this->belongsTo(Publisher::class);
  }

  public function peminjaman(): HasMany
  {
    return $this->hasMany(Peminjaman::class)->whereNull('return_date');
  }

  public function genre(): BelongsToMany
  {
    return $this->belongsToMany(Genre::class, 'genre_book', 'book_id', 'genre_id');
  }
}
