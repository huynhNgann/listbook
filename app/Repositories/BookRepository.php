<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookRepository
{
    protected $book,$author,$category;

    public function __construct(Book $book,Category $category,Author $author)
    {
        $this->book = $book;
        $this->category=$category;
        $this->author=$author;
    }
    public function getAllBook()
    {
        return $this->book->with('categories','authors')
        ->select('books.*','categories.*','authors.*', 'authors.name as author_name', 'categories.name as category_name')->paginate(1);
    }
    public function getAllCategories()
    {
      //  return $this->book->with('categories')->get();
        return $this->category->get();
        //return Category::all();
    }
    public function getAllAuthors(){
        //return $this->book->with('authors')->get();
       return $this->author->get();
    }
    public function getAllHavePaginate()
    {
        return $this->book->paginate(10);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $book = $this->book->create($data);
            if ($book) {
                DB::commit();
                return true;
            }
            DB::rollBack();
            return false;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }

    public function find(int $id)
    {
        try {
            return $this->book->find($id);
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $book = $this->find($id);
            if ($book) {
                $book->update($data);
                DB::commit();
                return true;
            }
            DB::rollBack();
            return false;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }
    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            $book = $this->find($id);
            if ($book) {
                $book->delete();
                DB::commit();
                return true;
            }
            DB::rollBack();
            return false;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }
}
