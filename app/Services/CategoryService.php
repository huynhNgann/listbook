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
     * Function: get all category
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
            $result = [
                'status' => false,
                'message' => 'Create new category unsuccessfully. Please check again.'
            ];
            $cate = $this->categoryRepository->create($data);
            if (!empty($cate)) {
                $result = [
                    'status' => true,
                    'message' => 'Create new category successfully.'
                ];
            }
            return $result;
        } catch (\Exception $e) {
            Log::error($e);
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }
    /**
     * Function create find id_cate
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int cate_id
     * @return array
     */
    public function find($cate_id = 0)
    {
        $category = $this->categoryRepository->find($cate_id);
       try{
        $result = [
            'status' => false,
        ];
        if (empty($category))
            $result['message'] = 'Category not found.';
        else {
            $result = [
                'status' => true,
                'category' => $category
            ];
        }
        return $result;
    }catch (\Exception $e) {
        Log::error($e);
        return [
            'status' => false,
            'message' => 'A system error has occurred. Please check logs.'
        ];
    }
    }
    /**
     * Function create update category
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int category_id, array
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
            $result = [
                'status' => false,
                'message' => 'Update category unsuccessfully. Please check again.'
            ];
            $category = $this->categoryRepository->update($cate_id,$data);
            if (!empty($category)) {
                $result = [
                    'status' => true,
                    'message' => 'Create new cate successfully.'
                ];
            }
            return $result;
        } catch (\Exception $e) {
            Log::error($e);
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }
    /**
     * Function delete cate
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int cate_id
     * @return array
     */
    public function delete($cate_id = 0)
    {
        $cate_deleted = $this->categoryRepository->delete($cate_id);
        try{
            if ($cate_deleted) {
            $result = [
                'status' => true,
                'message' => 'Delete Category successfully'
            ];
        } else {
            $result = [
                'status' => false,
                'message' => 'Delete category  unsuccessfully. Please check again.'
            ];
        }
        return $result;
    }
    catch (\Exception $e) {
        Log::error($e);
        return [
            'status' => false,
            'message' => 'A system error has occurred. Please check logs.'
        ];
    }
}
}
