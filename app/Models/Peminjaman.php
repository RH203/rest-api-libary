<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{

  use SoftDeletes;
  protected $fillable = ['borrow_date', 'return_date', 'notes', 'student_id', 'book_id'];
  protected $casts = [
    'borrow_date' => 'datetime',
    'return_date' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'deleted_at' => 'datetime',
  ];

  public function studentProfile(): BelongsTo
  {
    return $this->belongsTo(StudentProfile::class);
  }

  public function book(): BelongsTo
  {
    return $this->belongsTo(Book::class);
  }
}
