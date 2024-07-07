<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function getAllCategory()
    {
        return $this->category->all();
    }

    public function getAllHavePaginate()
    {
        return $this->category->paginate(5);
    }
    public function create($data)
    {
        DB::beginTransaction();
        try {
            $category = $this->category->create($data);
            if ($category) {
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
            return $this->category->find($id);
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $category = $this->find($id);
            if ($category) {
                $category->update($data);
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
            $category= $this->find($id);
            if ($category) {
                $category->delete();
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
