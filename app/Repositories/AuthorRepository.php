<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthorRepository
{
    protected $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }
    public function getAllAuthor()
    {
        return $this->author->all();
    }

    public function getAllHavePaginate()
    {
        return $this->author->paginate(5);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $author = $this->author->create($data);
            if ($author) {
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
            return $this->author->find($id);
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $author = $this->find($id);
            if ($author) {
                $author->update($data);
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
            $author = $this->find($id);
            if ($author) {
                $author->delete();
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
