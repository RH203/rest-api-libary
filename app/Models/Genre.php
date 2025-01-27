<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
  use SoftDeletes;
  protected $fillable = ['name'];


  public function book(): BelongsToMany
  {
    return $this->belongsToMany(Book::class);
  }
}
