<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\BaseController;
use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
  /**
   * Peminjnaman buku
   */
  public function borrowBook(Request $request)
  {
    try {
      $validate = $request->validate([
        'student_id' => 'required|numeric',
        'book_id' => 'required|numeric',
        'notes' => 'required|string'
      ], [
        'student_id.required' => 'ID siswa tidak boleh kosong',
        'student_id.numeric' => 'ID siswa harus berupa angka',
        'book_id.required' => 'ID buku tidak boleh kosong',
        'book_id.numeric' => 'ID buku harus berupa angka',
        'notes.required' => 'Catatan tidak boleh kosong',
        'notes.string' => 'Catatan harus berupa string'
      ]);

      $data = Peminjaman::where('book_id', $validate['book_id'])->where('student_id', $validate['student_id'])->first();

      if ($data) {
        return $this->error('Satu id cuma bisa meminjam satu buku yang sama.', 400);
      }

      $book = Book::find($validate['book_id']);

      if (!$book) {
        return $this->error('Buku tidak ditemukan', 404);
      }

      if ($book->stock <= 0) {
        return $this->error('Out of Stock', 404);
      }

      DB::transaction(function () use ($validate, $book) {
        Peminjaman::create([
          'borrow_date' => now(),
          'book_id' => $validate['book_id'],
          'student_id' => $validate['student_id'],
          'notes' => $validate['notes']
        ]);

        $book->stock = $book->stock - 1;
        $book->save();
      });

      return $this->success('Buku berhasil dipinjam');
    } catch (\Throwable $th) {
      return $this->error('Terjadi kesalahan, silakan coba lagi', 500);
    }
  }


  /**
   * Melihat semua buku
   */
  public function getBook()
  {
    try {
      $book = Book::with(['genre.name', 'publisher.name'])->get();

      return $this->success($book);
    } catch (\Throwable $th) {
      return $this->error('Failed fetch book', 500);
    }
  }

  /**
   * Melihat detail buku by id
   */
  public function getDetailBook(Request $request)
  {
    try {
      $validate = $request->validate([
        'book_id' => 'required|numeric'
      ], [
        'book_id.required' => 'ID buku tidak boleh kosong',
        'book_id.numeric' => 'ID buku harus berupa angka'
      ]);

      $book = Book::with([
        'peminjaman' => [
          'borrow_date',
          'return_date',
        ],
        'peminjaman.studentProfile.full_name',
        'genre.name',
        'publisher.name'
      ])->findOrFail($validate['book_id']);

      return $this->success($book);
    } catch (\Throwable $th) {
      return $this->error('Book not found', 500);
    }
  }

  /**
   * Mengembalikan buku
   */
  public function returnBook(Request $request) {
    try {
      $validated = $request->validate([
        'book_id' => 'required|numeric',
        'student_id' => 'required|numeric'
      ], [
        'book_id.required' => 'ID buku tidak boleh kosong',
        'book_id.numeric' => 'ID buku harus berupa angka',
        'student_id.required' => 'ID siswa tidak boleh kosong',
        'student_id.numeric' => 'ID siswa harus berupa angka'
      ]);

      $peminjaman = Peminjaman::where('book_id', $validated['book_id'])
        ->where('student_id', $validated['student_id'])
        ->whereNull('return_date')
        ->first();

        if(! $peminjaman) {
          return $this->error('Peminjaman tidak ditemukan', 404);
        }

        $updateStock = Book::find($validated['book_id']);
        if (!$updateStock) {
            return $this->error('Buku tidak ditemukan', 404);
        }

        DB::transaction(function () use ($peminjaman, $validated, $updateStock) {
          $updateStock->stock = $updateStock->stock + 1;

          $peminjaman->return_date = now();

          $updateStock->save();
          $peminjaman->save();

        });

        return $this->success('Buku berhasil dikembalikan');
    } catch (\Throwable $th) {
      return $this->error('Failed return book', 500);
    }
  }
}
