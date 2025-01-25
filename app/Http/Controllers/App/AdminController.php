<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\BaseController;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

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
      return $this->error($e->getMessage());
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
      return $this->error($e->getMessage());
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
      return $this->error($th->getMessage());
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
      return $this->error($th->getMessage());
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
      return $this->error($th->getMessage());
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
      return $this->error($e->getMessage());
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
      return $this->error($th->getMessage());
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
      return $this->error($th->getMessage());
    }
  }

  /**
   * List account user
   */
  public function getUser()
  {
    try {
      if (Cache::has('user')) {
        return $this->success( Cache::get('user'));
      }

      $data = User::all();
      Cache::put('user', $data, 604800);
      return $this->success($data);
    } catch (\Throwable $th) {
      return $this->error($th->getMessage());
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
      return $this->error($th->getMessage());
    }
  }

  /**
   * Delete account user
   */
  public function deleteUser (Request $request) {
    try {
      $validate = $request->validate([
        'id'=> 'required|numeric',
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
      return $this->error($th->getMessage());
    }
  }
}
