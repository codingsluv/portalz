<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/{slug}', [NewsController::class, 'category'])->name('news.category');

Route::get('/authors/{username}', [AuthorController::class, 'show'])->name('authors.show');
