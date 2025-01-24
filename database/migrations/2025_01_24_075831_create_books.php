<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('books', function (Blueprint $table) {

      $table->id();

      $table->string('image')->nullable();
      $table->string('title', 255);
      $table->string('description', 255)->nullable();
      $table->string('author', 255);
      $table->string('isbn', 255)->nullable()->unique();
      $table->integer('stock')->default(0)->nullable();
      $table->foreignId('publisher_id')->constrained('publishers')->cascadeOnDelete();

      $table->timestamps();

      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('books');
  }
};
