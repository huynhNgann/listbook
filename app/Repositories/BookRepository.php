<?php

namespace App\Repositories;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookRepository
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
    public function getAllBook()
    {
        return $this->book->with('category:id,name','author:id,name')
        ->select('books.*')
        ->paginate(10);
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
            Log::error('Error creating book: ' . $e->getMessage());
            return false;
        }
    }

    public function find(int $id)
    {
        try {
            return $this->book->with('category','author')->find($id);
        } catch (\Exception $e) {
            Log::error('Error finding book: ' . $e->getMessage());
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
            Log::error('Error updating book: ' . $e->getMessage());
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
            Log::error('Error deleting book: ' . $e->getMessage());
            return false;
        }
    }
}
