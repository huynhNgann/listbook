<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;


Route::get('/',function(){
    return redirect('/book');
});
Route::get('/logout',function(){
    auth()->logout();
    return redirect('/book');
})->name('logout');
Route::get('/book', function () {                                                 
    return view('book.index');
})->middleware(['guest', 'verified']);
//author
Route::get('author/delete/{id}',[AuthorController::class,'destroy'])->name('author.destroy');
Route::resource('author', AuthorController::class)->except(['destroy']);
//category
Route::get('category/delete/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
Route::resource('category', CategoryController::class)->except(['destroy']);
//book
Route::get('book/delete/{id}',[BookController::class,'destroy'])->name('book.destroy');
Route::resource('book', BookController::class)->except(['destroy']);

require __DIR__.'/auth.php';
