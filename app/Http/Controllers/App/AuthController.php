<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
  /**
   * Controller registrasi
   * Menangani proses pendaftaran pengguna baru
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function registrasi(Request $request)
  {
    try {
      $validate = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string|min:8'
      ], [
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Email tidak valid',
        'password.required' => 'Password tidak boleh kosong',
        'password.min' => 'Password harus memiliki minimal 8 karakter'
      ]);

      $data = User::where('email', $validate['email'])->first();
      if ($data) {
        return $this->error('Email sudah terdaftar');
      }

      User::create([
        'email' => $validate['email'],
        'password' => Hash::make($validate['password'])
      ]);

      return $this->success('Registrasi berhasil');
    } catch (\Illuminate\Validation\ValidationException $e) {
      return $this->error('Data yang Anda masukkan tidak valid. Silakan periksa kembali.');
    } catch (\Exception $e) {
      return $this->error('Terjadi kesalahan, silakan coba lagi nanti: ' . $e->getMessage());
    }
  }


  /**
   * Controller login
   * Mengautentikasi pengguna berdasarkan email dan password
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    try {
      $validate = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string'
      ], [
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Email tidak valid',
        'password.required' => 'Password tidak boleh kosong'
      ]);

      $data = User::where('email', $validate['email'])->first();

      if ($data && Hash::check($validate['password'], $data->password)) {

        $data->tokens()->delete();

        $token = $data->createToken('login_' . $data->email, [$data->role]);

        return $this->success($token->plainTextToken);
      }

      return $this->error('Email atau password salah');
    } catch (ValidationException $e) {
      return $this->error('Data yang Anda masukkan tidak valid. Silakan periksa kembali.');
    } catch (\Exception $e) {
      return $this->error('Terjadi kesalahan, silakan coba lagi nanti: ' . $e->getMessage());
    }
  }

}
