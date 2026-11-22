<?php

use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\UserCollectionController;
use Illuminate\Support\Facades\Route;

// CRUD standar untuk entitas Media
Route::apiResource('media', MediaController::class);

// Custom actions untuk koleksi media milik User (Many-to-Many)
Route::get('/users/{user}/collections', [UserCollectionController::class, 'index']);
Route::post('/users/{user}/collections', [UserCollectionController::class, 'addToCollection']);
Route::delete('/users/{user}/collections/{media}', [UserCollectionController::class, 'removeFromCollection']);
