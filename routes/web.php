<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckRole;


Route::get('/book', function () {                                                 
    return view('book.index');
})->middleware(['guest', 'verified']);

Route::middleware('auth')->group(function () {
    Route::resources([
        'author' => AuthorController::class,
        'category' => CategoryController::class,
    'book' => BookController::class,
    ]);
});

Route::get('admin/dashboard',[AdminController::class,'dashboard'])->middleware('admin');
//middle wave
//Route::get('admin/dashboard'
require __DIR__.'/auth.php';
