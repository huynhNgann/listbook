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
     * Function: get all authors with pagination
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
            $author = $this->authorRepository->create($data);
            if ($author) {
                return [
                    'status' => true,
                    'message' => 'Create new author successfully.',
                    'author' => $author
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Create new author unsuccessfully. Please check again.'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error creating author: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }

    /**
     * Function find author by id
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int $author_id
     * @return array
     */
    public function find($author_id = 0)
    {
        try {
            $author = $this->authorRepository->find($author_id);
            if (empty($author)) {
                return [
                    'status' => false,
                    'message' => 'Author not found.'
                ];
            } else {
                return [
                    'status' => true,
                    'author' => $author
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error finding author: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }

    /**
     * Function update author
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int $author_id
     * @param array $data
     * @return array
     */
    public function update($author_id = 0, array $data = array())
    {
        if (empty($data)) {
            return [
                'status' => false,
                'message' => 'Inputs empty.'
            ];
        }

        try {
            $authorUpdated = $this->authorRepository->update($author_id, $data);
            if ($authorUpdated) {
                return [
                    'status' => true,
                    'message' => 'Update author successfully.'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Update author unsuccessfully. Please check again.'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error updating author: ' . $e->getMessage());
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
     * @param int $author_id
     * @return array
     */
    public function delete($author_id = 0)
    {
        try {
            $authorDeleted = $this->authorRepository->delete($author_id);
            if ($authorDeleted) {
                return [
                    'status' => true,
                    'message' => 'Delete author successfully.'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Delete author unsuccessfully. Please check again.'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error deleting author: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }
}
