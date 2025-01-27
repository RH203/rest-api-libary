<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('peminjamen', function (Blueprint $table) {
      $table->id();
      $table->dateTime('borrow_date')->nullable();
      $table->dateTime('return_date')->nullable();
      $table->text('notes')->nullable();
      $table->foreignId('student_id')->constrained('student_profiles')->cascadeOnDelete();
      $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
      $table->timestamps();
      $table->softDeletes();
      // $table->unique(['student_id', 'book_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('peminjamen');
  }
};
