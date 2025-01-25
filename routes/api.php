<?php

use App\Http\Controllers\App\AdminController;
use App\Http\Controllers\App\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::prefix('admin')->middleware(['auth:sanctum', 'abilities:admin'])->group(function () {
  Route::get('/get-genre', [AdminController::class, 'getGenre']);
  Route::post('/delete-user', [AdminController::class, 'deleteUser']);
});
