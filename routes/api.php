<?php

use App\Http\Controllers\App\AdminController;
use App\Http\Controllers\App\AuthController;
use Illuminate\Support\Facades\Route;

// Route untuk login dan registrasi
Route::post('/login', [AuthController::class, 'login']); // Route untuk login
Route::post('/register', [AuthController::class, 'register']); // Route untuk registrasi

// Route dengan prefix 'admin' dan middleware 'auth:sanctum' & 'abilities:admin'
Route::prefix('admin')->middleware(['auth:sanctum', 'abilities:admin'])->group(function () {

  // === Routes untuk Genre ===
  Route::prefix('genre')->group(function () {
    Route::get('/get-all', [AdminController::class, 'getGenre']); // Get all genre
    Route::post('/create', [AdminController::class, 'createNewGenre']); // Create new genre
    Route::post('/update', [AdminController::class, 'updateGenre']); // Update existing genre
    Route::post('/delete', [AdminController::class, 'deleteGenre']); // Delete genre
  });

  // === Routes untuk Publisher ===
  Route::prefix('publisher')->group(function () {
    Route::get('/get-all', [AdminController::class, 'getPublisher']); // Get all publisher
    Route::post('/create', [AdminController::class, 'createNewPublisher']); // Create new publisher
    Route::post('/update', [AdminController::class, 'updatePublisher']); // Update existing publisher
    Route::post('/delete', [AdminController::class, 'deletePublisher']); // Delete publisher
  });

  // === Routes untuk User ===
  Route::prefix('user')->group(function () {
    Route::get('/get-all', [AdminController::class, 'getUser']); // Get all users
    Route::post('/update', [AdminController::class, 'updateUser']); // Update user data
    Route::post('/delete', [AdminController::class, 'deleteUser']); // Delete user
    Route::post('/ban-user', [AdminController::class, 'banUser']); // Ban user
  });

  // === Routes untuk Book ===
  Route::prefix('book')->group(function () {
    Route::post('/update', [AdminController::class, 'updateBook']); // Update book details
  });
});
