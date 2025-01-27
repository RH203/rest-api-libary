<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\BaseController;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Peminjaman;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminController extends BaseController
{
  /**
   * Get all genre
   */
  public function getGenre()
  {
    try {
      if (Cache::has("genre")) {
        return $this->success(Cache::get("genre"));
      }

      $data = Genre::all();
      Cache::put("genre", $data, 604800);
      return $this->success($data);
    } catch (\Exception $e) {
      return $this->error('Something went wrong while fetching the genres.');
    }
  }

  /**
   * Create new genre
   */
  public function createNewGenre(Request $request)
  {
    try {
      $validate = $request->validate([
        'name' => 'required|string',
      ], [
        'name.required' => 'Name is required',
        'name.string' => 'Name must be a string'
      ]);

      $data = Genre::where('name', $validate['name'])->first();
      if ($data) {
        return $this->error("Genre already exists");
      }

      Genre::create($validate);
      return $this->success('Genre created');
    } catch (\Exception $e) {
      return $this->error('Failed to create genre.');
    }
  }

  /**
   * Edit genre
   */
  public function updateGenre(Request $request)
  {
    try {
      $validate = $request->validate([
        'id' => 'required|numeric',
        'name' => 'required|string'
      ], [
        'id.required' => 'ID is required',
        'id.numeric' => 'ID must be a number',
        'name.required' => 'Name is required',
        'name.string' => 'Name must be a string'
      ]);

      $data = Genre::find($validate['id']);
      if ($data) {
        $data->name = $validate['name'];
        $data->save();
        return $this->success('Genre updated');
      }

      return $this->error('Genre not found');
    } catch (\Throwable $th) {
      return $this->error('Failed to update genre.');
    }
  }

  /**
   * Delete genre
   */
  public function deleteGenre(Request $request)
  {
    try {
      $validate = $request->validate([
        'id' => 'required|numeric',
      ], [
        'id.required' => 'ID is required',
        'id.numeric' => 'ID must be a number'
      ]);

      $data = Genre::find($validate['id']);
      if ($data) {
        $data->delete();
        return $this->success('Genre deleted');
      }

      return $this->error('Genre not found');
    } catch (\Throwable $th) {
      return $this->error('Failed to delete genre.');
    }
  }

  /**
   * Get all publisher
   */
  public function getPublisher()
  {
    try {
      if (Cache::has('publisher')) {
        return $this->success(Cache::get('publisher'));
      }

      $data = Publisher::all();
      Cache::put('pub;isher', $data, 604800);
      return $this->success($data);
    } catch (\Throwable $th) {
      return $this->error('Failed to fetch publishers.');
    }
  }

  /**
   * Create new publisher
   */
  public function createNewPublisher(Request $request)
  {
    try {
      $validate = $request->validate([
        'name' => 'required|string',
      ], [
        'name.required' => 'Name is required',
        'name.string' => 'Name must be a string',
      ]);

      $data = Publisher::where('name', $validate['name'])->first();
      if ($data) {
        return $this->error("Publisher already exists");
      }

      Publisher::create($validate);
      return $this->success('Publisher created');
    } catch (\Exception $e) {
      return $this->error('Failed to create publisher.');
    }
  }

  /**
   * Edit publisher
   */
  public function updatePublisher(Request $request)
  {
    try {
      $validate = $request->validate([
        'id' => 'required|numeric',
        'name' => 'required|string',
      ], [
        'id.required' => 'ID is required',
        'id.numeric' => 'ID must be a number',
        'name.required' => 'Name is required',
        'name.string' => 'Name must be a string',
      ]);

      $data = Publisher::find($validate['id']);
      if ($data) {
        $data->name = $validate['name'];
        $data->save();
        return $this->success('Publisher updated');
      }

      return $this->error('Publisher not found');
    } catch (\Throwable $th) {
      return $this->error('Failed to update publisher.');
    }
  }

  /**
   * Delete publisher
   */
  public function deletePublisher(Request $request)
  {
    try {
      $validate = $request->validate([
        'id' => 'required|numeric',
      ], [
        'id.required' => 'ID is required',
        'id.numeric' => 'ID must be a number',
      ]);

      $data = Publisher::find($validate['id']);
      if ($data) {
        $data->delete();
        return $this->success('Publisher deleted');
      }

      return $this->error('Publisher not found');
    } catch (\Throwable $th) {
      return $this->error('Failed to delete publisher.');
    }
  }

  /**
   * List account user
   */
  public function getUser()
  {
    try {
      if (Cache::has('user')) {
        return $this->success(Cache::get('user'));
      }

      $data = User::all();
      Cache::put('user', $data, 604800);
      return $this->success($data);
    } catch (\Throwable $th) {
      return $this->error('Failed to fetch users.');
    }
  }

  /**
   * Edit account user
   */
  public function updateUser(Request $request)
  {
    try {
      $validate = $request->validate([
        'id' => 'required|numeric',
        'email' => 'required|email',
        'password' => 'required|string|min:8',
      ], [
        'id.required' => 'ID is required',
        'id.numeric' => 'ID must be a number',
        'email.required' => 'Email is required',
        'email.email' => 'Email must be a valid email',
        'password.required' => 'Password is required',
        'password.string' => 'Password must be a string',
        'password.min' => 'Password must be at least 8 characters',
      ]);

      $data = User::find($validate['id']);
      if ($data) {
        $data->update([
          'email' => $validate['email'],
          'password' => Hash::make($validate['password']),
        ]);
        return $this->success('User updated');
      }
      return $this->error('User not found');
    } catch (\Throwable $th) {
      return $this->error('Failed to update user.');
    }
  }

  /**
   * Delete account user
   */
  public function deleteUser(Request $request)
  {
    try {
      $validate = $request->validate([
        'id' => 'required|numeric',
      ]);

      $user = User::find($validate['id']);
      $userProfie = $user->studentProfile()->first();
      if ($userProfie && $user) {
        $user->deleted_at = now();
        $userProfie->deleted_at = now();

        $userProfie->save();
        $user->save();
        return $this->success('User deleted');
      }

      return $this->error('User not found');
    } catch (\Throwable $th) {
      return $this->error('Failed to delete user.');
    }
  }

  /**
   * Ban account user
   */
  public function banUser(Request $request)
  {
    try {
      $validate = $request->validate([
        'id' => 'required|numeric',
      ], [
        'id.required' => 'ID is required',
        'id.numeric' => 'ID must be a number',
      ]);

      $user = User::findOrFail($validate['id']);
      $userProfile = $user->studentProfile()->first();
      $userProfile->deleted_at = now();
      $user->ban_status = true;
      $user->save();
      $userProfile->save();

      return $this->success('User ' . $userProfile->full_name . ' banned');
    } catch (\Throwable $th) {
      return $this->error('Failed to ban user.');
    }
  }

  /**
   * Update book detail
   */
  public function updateBook(Request $request)
  {
    try {
      $validate = $request->validate([
        'id' => 'required|numeric',
        'image' => 'required|mimes:jpeg,jpg,png|max:5120',
        'title' => 'required|string',
        'description' => 'required|string',
        'author' => 'required|string',
        'isbn' => 'required|string',
        'stock' => 'required|numeric',
        'publisher_id' => 'required|numeric',
        'genre_id' => 'required|array|distinct',
        'genre_id.*' => 'numeric|exists:genres,id',
      ], [
        'id.required' => 'ID is required',
        'id.numeric' => 'ID must be a number',
        'image.required' => 'Image is required',
        'image.mimes' => 'Image must be a jpeg, jpg, or png',
        'image.max' => 'Image must be less than 5MB',
        'title.required' => 'Title is required',
        'title.string' => 'Title must be a string',
        'description.required' => 'Description is required',
        'description.string' => 'Description must be a string',
        'author.required' => 'Author is required',
        'author.string' => 'Author must be a string',
        'isbn.required' => 'ISBN is required',
        'isbn.string' => 'ISBN must be a string',
        'stock.required' => 'Stock is required',
        'stock.numeric' => 'Stock must be a number',
        'publisher_id.required' => 'Publisher ID is required',
        'publisher_id.numeric' => 'Publisher ID must be a number',
        'genre_id.required' => 'Genre ID is required',
        'genre_id.array' => 'Genre ID must be an array',
        'genre_id.*.numeric' => 'Genre ID must be a number',
        'genre_id.*.exists' => 'Genre ID not found',
        'genre_id.*.distinct' => 'Genre ID must be unique',
      ]);

      $book = Book::findOrFail($validate['id']);

      if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('public/images/books', $filename);
        $book->image = $imagePath;
      }

      $book->title = $validate['title'];
      $book->description = $validate['description'];
      $book->author = $validate['author'];
      $book->isbn = $validate['isbn'];
      $book->stock = $validate['stock'];
      $book->publisher_id = $validate['publisher_id'];
      $book->save();

      DB::table('genre_book')->where('book_id', $validate['id'])->update(['deleted_at' => now()]);

      foreach ($validate['genre_id'] as $genreId) {
        $book->genres()->attach($genreId, ['deleted_at' => null]);
      }

      return $this->success('Book updated successfully');
    } catch (\Throwable $th) {
      return $this->error('Failed to update book.');
    }
  }

  /**
   * Melihat daftar peminjam
   */
  public function getPeminjaman()
  {
    try {
      $peminjaman = Peminjaman::with([
        'studentProfile.full_name',
        'books' => [
          'title',
          'stock'
        ]
      ])->get();


      return $this->success($peminjaman);
    } catch (\Throwable $th) {
      return $this->error('Failed to fetch list peminjam.');
    }
  }
}
