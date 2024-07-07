<?php

namespace App\Services;

use App\Repositories\AuthorRepository;
use Illuminate\Support\Facades\Log;

class AuthorService
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getAllAuthor()
    {
        return $this->authorRepository->getAllAuthor();
    }
    /**
     * Function: get all author
     * Created at: 04/07/2024
     * Created by: Ngân
     * @return object
     */

    public function getAllHavePaginate()
    {
        return $this->authorRepository->getAllHavePaginate();
    }

    /**
     * Function create new author
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
                'message' => 'Create new author unsuccessfully. Please check again.'
            ];
            $author = $this->authorRepository->create($data);
            if (!empty($author)) {
                $result = [
                    'status' => true,
                    'message' => 'Create new author successfully.'
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
     * Function create find id_author
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int author_id
     * @return array
     */
    public function find($author_id = 0)
    {
        $author = $this->authorRepository->find($author_id);
       try{
        $result = [
            'status' => false,
        ];
        if (empty($author))
            $result['message'] = 'Author not found.';
        else {
            $result = [
                'status' => true,
                'author' => $author
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
     * Function create update author
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int author_id, array
     * @return array
     */
    public function update($authod_id = 0, array $data = array())
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
                'message' => 'Update author unsuccessfully. Please check again.'
            ];
            $author = $this->authorRepository->update($authod_id,$data);
            if (!empty($author)) {
                $result = [
                    'status' => true,
                    'message' => 'Create new author successfully.'
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
     * Function delete author
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int author_id
     * @return array
     */
    public function delete($author_id = 0)
    {
        $author_deleted = $this->authorRepository->delete($author_id);
        try{
            if ($author_deleted) {
            $result = [
                'status' => true,
                'message' => 'Delete author successfully'
            ];
        } else {
            $result = [
                'status' => false,
                'message' => 'Delete author unsuccessfully. Please check again.'
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
