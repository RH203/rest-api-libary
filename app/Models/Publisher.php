<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{

  use SoftDeletes;

  protected $fillable = ['name'];
  public function book(): HasMany
  {
    return $this->hasMany(Book::class);
  }
}
