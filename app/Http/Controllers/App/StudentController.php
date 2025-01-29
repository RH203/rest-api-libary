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

      $data = Peminjaman::where('book_id', $validate['book_id'])->where('student_id', $validate['student_id'])->where('return_date', null)->first();

      if ($data) {
        return $this->error('Satu id cuma bisa meminjam satu buku yang sama.', 400);
      }

      $book = Book::find($validate['book_id']);

      if (!$book) {
        return $this->error('Buku tidak ditemukan', 404);
      }


      DB::transaction(function () use ($validate) {
        $book = Book::where('id', $validate['book_id'])->lockForUpdate()->first();

        if ($book->stock <= 0) {
          throw new \ErrorException('Stok buku habis dari custom', 400);
        }

        Peminjaman::create([
          'borrow_date' => now(),
          'book_id' => $validate['book_id'],
          'student_id' => $validate['student_id'],
          'notes' => $validate['notes']
        ]);

        $book->decrement('stock');
        $book->save();
      });

      return $this->success('Buku berhasil dipinjam');
    } catch (\Throwable $th) {
      return $this->error($th->getMessage(), 500);
    }
  }

  /**
   * Mengembalikan buku
   */
  public function returnBook(Request $request)
  {
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

      if (! $peminjaman) {
        return $this->error('Peminjaman tidak ditemukan', 404);
      }

      $updateStock = Book::find($validated['book_id']);
      if (!$updateStock) {
        return $this->error('Buku tidak ditemukan', 404);
      }

      DB::transaction(function () use ($validated, $peminjaman) {
        $updateStock = Book::where('id',  $validated['book_id'])->lockForUpdate()->first();
        $updateStock->increment('stock');

        $peminjaman->return_date = now();

        $updateStock->save();
        $peminjaman->save();
      });

      return $this->success('Buku berhasil dikembalikan');
    } catch (\Throwable $th) {
      return $this->error($th->getMessage(), 500);
    }
  }

  /**
   * Melihat semua buku
   */
  public function getBook()
  {
    try {
      $book = Book::with(['publisher:id,name', 'genre:id,name'])
        ->select('id', 'image', 'title', 'description', 'author', 'isbn', 'stock')
        ->paginate(10);

      return $this->successPaginate($book);
    } catch (\Throwable $th) {
      return $this->error($th->getMessage(), 500);
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
        'peminjaman',
        'genre:id,name',
        'publisher:id,name'
      ])->select('id', 'image', 'title', 'description', 'author', 'isbn', 'stock')->findOrFail($validate['book_id']);

      return $this->success($book);
    } catch (\Throwable $th) {
      return $this->error($th->getMessage(), 500);
    }
  }
}
