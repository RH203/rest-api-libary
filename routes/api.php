<?php
use App\Http\Controllers\App\AdminController;
use App\Http\Controllers\App\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']); // Route untuk login
Route::post('/register', [AuthController::class, 'register']); // Route untuk registrasi

Route::prefix('admin')->middleware(['auth:sanctum', 'abilities:admin'])->group(function () {
    // Route untuk mendapatkan semua genre
    Route::get('/get-genre', [AdminController::class, 'getGenre']); // Get all genre
    
    // Route untuk mendapatkan semua publisher
    Route::get('/get-publisher', [AdminController::class, 'getPublisher']); // Get all publisher

    // Route untuk mendapatkan semua user
    Route::get('/get-user', [AdminController::class, 'getUser']); // Get all users

    // Route untuk membuat genre baru
    Route::post('/create-genre', [AdminController::class, 'createNewGenre']); // Create new genre
    
    // Route untuk mengedit genre
    Route::post('/update-genre', [AdminController::class, 'updateGenre']); // Update existing genre

    // Route untuk menghapus genre
    Route::post('/delete-genre', [AdminController::class, 'deleteGenre']); // Delete genre

    // Route untuk membuat publisher baru
    Route::post('/create-publisher', [AdminController::class, 'createNewPublisher']); // Create new publisher

    // Route untuk mengedit publisher
    Route::post('/update-publisher', [AdminController::class, 'updatePublisher']); // Update existing publisher

    // Route untuk menghapus publisher
    Route::post('/delete-publisher', [AdminController::class, 'deletePublisher']); // Delete publisher

    // Route untuk mengedit data user
    Route::post('/update-user', [AdminController::class, 'updateUser']); // Update user data
    
    // Route untuk menghapus user
    Route::post('/delete-user', [AdminController::class, 'deleteUser']); // Delete user
    
    // Route untuk memperbarui detail buku
    Route::post('/update-book', [AdminController::class, 'updateBook']); // Update book details
});
