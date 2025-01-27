<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\Gender;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('student_profiles', function (Blueprint $table) {
      $table->id();
      $table->string('image')->nullable();
      $table->string('full_name');
      $table->string('phone_number')->nullable();
      $table->text('address')->nullable();
      $table->enum('gender', [Gender::MALE->value, Gender::FEMALE->value])->nullable();
      $table->date('date_of_birth')->nullable();
      $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
      $table->boolean('ban_status')->nullable()->default(false);
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('student_profiles');
  }
};
