<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategory()
    {
        return $this->categoryRepository->getAllCategory();
    }

    /**
     * Function: get all categories with pagination
     * Created at: 04/07/2024
     * Created by: Ngân
     * @return object
     */
    public function getAllHavePaginate()
    {
        return $this->categoryRepository->getAllHavePaginate();
    }

    /**
     * Function create new category
     * Created at: 04/07/2024
     * Created by: Ngân
     * 
     * @param array $data
     * @return array
     */
    public function create(array $data = array())
    {
        if (empty($data)) {
            return [
                'status' => false,
                'message' => 'Inputs empty.'
            ];
        }

        try {
            $category = $this->categoryRepository->create($data);
            if ($category) {
                return [
                    'status' => true,
                    'message' => 'Create new category successfully.',
                    'category' => $category
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Create new category unsuccessfully. Please check again.'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }

    /**
     * Function find category by id
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int $cate_id
     * @return array
     */
    public function find($cate_id = 0)
    {
        try {
            $category = $this->categoryRepository->find($cate_id);
            if (empty($category)) {
                return [
                    'status' => false,
                    'message' => 'Category not found.'
                ];
            } else {
                return [
                    'status' => true,
                    'category' => $category
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error finding category: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }

    /**
     * Function update category
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int $cate_id
     * @param array $data
     * @return array
     */
    public function update($cate_id = 0, array $data = array())
    {
        if (empty($data)) {
            return [
                'status' => false,
                'message' => 'Inputs empty.'
            ];
        }

        try {
            $categoryUpdated = $this->categoryRepository->update($cate_id, $data);
            if ($categoryUpdated) {
                return [
                    'status' => true,
                    'message' => 'Update category successfully.'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Update category unsuccessfully. Please check again.'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }

    /**
     * Function delete category
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int $cate_id
     * @return array
     */
    public function delete($cate_id = 0)
    {
        try {
            $categoryDeleted = $this->categoryRepository->delete($cate_id);
            if ($categoryDeleted) {
                return [
                    'status' => true,
                    'message' => 'Delete category successfully.'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Delete category unsuccessfully. Please check again.'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }
}
