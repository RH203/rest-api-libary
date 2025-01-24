<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User account
      User::create([
        'email' => 'user@gmail.com',
        'password' => Hash::make('password'),
      ]);
      // Admin account
      User::create([
        'email' => 'admin@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
      ]);
    }
}
