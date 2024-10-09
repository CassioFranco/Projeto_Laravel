<?php


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SupportController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::post('/supports/trocar', [SupportController::class,'trocarItems'])->name('trocarItems.explorador');
Route::put('/supports/{id}/troca', [SupportController::class, 'troca'])->name('supports.troca');

Route::middleware(['auth:sanctum'])->group(function() {
    Route::apiResource('/supports',SupportController::class);
});

// Route::apiResource('/supports',SupportController::class);

