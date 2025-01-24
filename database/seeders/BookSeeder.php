<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;

class BookSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $publisher = Publisher::find(1);
    if (!$publisher) {
      $this->command->info('Publisher dengan ID 1 tidak ditemukan. Seeding publisher terlebih dahulu.');
      return;
    }

    // Membuat data buku
    $data = [
      'title' => 'The Silent Observer',
      'description' => Faker::create()->text(),
      'author' => Faker::create()->name(),
      'isbn' => Faker::create()->isbn13(),
      'stock' => Faker::create()->randomDigit(),
      'publisher_id' => $publisher->id,
    ];

    $book = Book::create($data);

    $genres = Genre::inRandomOrder()->take(3)->pluck('id');

    // Menambahkan data ke tabel pivot genre_book menggunakan query builder
    foreach ($genres as $genreId) {
      DB::table('genre_book')->insert([
        'book_id' => $book->id,
        'genre_id' => $genreId,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
