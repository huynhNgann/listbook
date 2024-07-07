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

    public function __construct(Book $book,Author $author,Category $category)
    {
        $this->book = $book;
        $this->author=$author;
        $this->category=$category;
    }
    public function getAllBook()
    {
        return $this->book->join('authors', 'books.author_id', '=', 'authors.id')
        ->join('categories', 'books.category_id', '=', 'categories.id')
        ->select('books.*', 'authors.name as author_name', 'categories.name as category_name')
        ->paginate(5);
    }
    public function getAllCategory(){
        return $this->category->all();
    }
    public function getAllAuthor(){
        return $this->author->all();
    }
    public function getByAuthor($author_id)
    {
        try {
            $author_id=$this->author->id->get();
            $result = $this->book->where('author_id',$author_id)
            ->where('id','==',$this->author->id)
            ->get();
            return $result;
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
    }
    public function getWhereCategory($category_id)
    {
        try {
            $result = $this->book->where('category_id',$category_id)
            ->where('id','==',$this->category->id)
            ->get();
            return $result;
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
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
