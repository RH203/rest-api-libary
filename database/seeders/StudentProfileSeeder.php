<?php

namespace Database\Seeders;

use App\Enum\Gender;
use App\Models\StudentProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentProfileSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void {
    StudentProfile::create([
      'image' => '',
      'full_name' => 'User Satu',
      'phone_number' => '081234567890',
      'address' => 'Jl. Lorem Ipsum Dolor Sit Amet',
      'gender' => Gender::MALE->value,
      'date_of_birth' => '2000-01-01',
      'user_id' => 1,
    ]);
    
  }
}
