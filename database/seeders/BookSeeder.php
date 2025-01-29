<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;

class BookSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $bookTitles = [
      "The Adventures of Sherlock Holmes",
      "To Kill a Mockingbird",
      "Pride and Prejudice",
      "The Great Gatsby",
      "1984",
      "Moby-Dick",
      "The Catcher in the Rye",
      "Little Women",
      "The Hobbit",
      "Harry Potter and the Sorcerer’s Stone",
      "The Lord of the Rings",
      "The Chronicles of Narnia",
      "Alice’s Adventures in Wonderland",
      "The Hunger Games",
      "Divergent",
      "Percy Jackson & The Olympians: The Lightning Thief",
      "The Maze Runner",
      "The Fault in Our Stars",
      "The Book Thief",
      "Brave New World",
      "Fahrenheit 451",
      "The Alchemist",
      "A Tale of Two Cities",
      "Dracula",
      "The Picture of Dorian Gray"
  ];
  
    for ($i = 0; $i < 25; $i++) {
     

      // Membuat data buku
      $data = [
        'image' => fake()->imageUrl(),
        'title' => $bookTitles[$i],
        'description' => fake()->sentence(),
        'author' => fake()->name(),
        'isbn' => fake()->isbn13(),
        'stock' => fake()->randomDigit(),
        'publisher_id' => fake()->randomDigitNotZero(),
      ];

      $book = Book::create($data);

      $genres = Genre::inRandomOrder()->take(3)->pluck('id');

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
}
