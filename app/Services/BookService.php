<?php

namespace App\Services;

use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Log;

class BookService
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    /**
     * Function: get all book
     * Created at: 04/07/2024
     * Created by: Ngân
     * @return object
     */
    public function getAllBook(){
        return $this->bookRepository->getAllBook();
    }
    public function getAllCategories(){
        return $this->bookRepository->getAllCategories();
    }
    public function getAllAuthors(){
        return $this->bookRepository->getAllAuthors();
    }
    public function getAllHavePaginate()
    {
        return $this->bookRepository->getAllHavePaginate();
    }

    /**
     * Function create new book
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
                'message' => 'Create new book unsuccessfully. Please check again.'
            ];
            $book = $this->bookRepository->create($data);
            if (!empty($book)) {
                $result = [
                    'status' => true,
                    'message' => 'Create new book successfully.'
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
     * Function create find id_book
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int book_id
     * @return array
     */
    public function find($book_id = 0)
    {
        $book = $this->bookRepository->find($book_id);
        $result = [
            'status' => false,
        ];
        if (empty($book))
            $result['message'] = 'Book not found.';
        else {
            $result = [
                'status' => true,
                'book' => $book
            ];
        }
        return $result;
    }
    /**
     * Function create update book
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int book_id, array
     * @return array
     */
    public function update($book_id = 0, array $data = array())
    {
        if (empty($data)) {
            return [
                'status' => false,
                'message' => 'Inputs empty.'
            ];
        }
       // $data['author_id']=$this->bookRepository->getWhereAuthor($book_id);
      //  $data['category_id']=$this->bookRepository->getWhereCategory($book_id);

        $book = $this->bookRepository->update($book_id,$data);
        
            if (!empty($book)) {
                $result = [
                    'status' => true,
                    'message' => 'Create new book successfully.'
                ];
            }else{
                $result = [
                    'status' => false,
                    'message' => 'Create new book unsuccessfully. Please check again.'
                ];
            }
            return $result;
        }
    
    /**
     * Function delete book
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int book_id
     * @return array
     */
    public function delete($book_id = 0)
    {
        $book_deleted = $this->bookRepository->delete($book_id);
        if ($book_deleted) {
            $result = [
                'status' => true,
                'message' => 'Delete book successfully'
            ];
        } else {
            $result = [
                'status' => false,
                'message' => 'Delete book unsuccessfully. Please check again.'
            ];
        }
        return $result;
    }
}
