<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
  protected $fillable = ['borrow_date', 'return_date', 'notes', 'student_id', 'book_id'];

  public function studentProfile(): BelongsTo
  {
    return $this->belongsTo(StudentProfile::class);
  }

  public function book(): BelongsTo
  {
    return $this->belongsTo(Book::class);
  }
}
