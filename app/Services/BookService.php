<?php

namespace App\Services;

use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BookService
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Function: get all books
     * Created at: 04/07/2024
     * Created by: Ngân
     * @return object
     */
    public function getAllBook()
    {
        return $this->bookRepository->getAllBook();
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
            $book = $this->bookRepository->create($data);
            if ($book) {
                return [
                    'status' => true,
                    'message' => 'Create new book successfully.'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Create new book unsuccessfully. Please check again.'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error creating book: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }

    /**
     * Function find book by id
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int $book_id
     * @return array
     */
    public function find($book_id = 0)
    {
        $book = $this->bookRepository->find($book_id);
        if (empty($book)) {
            return [
                'status' => false,
                'message' => 'Book not found.'
            ];
        } else {
            return [
                'status' => true,
                'book' => $this->formatData($book)
            ];
        }
    }

    public function formatData($book = null)
    {
        if (empty($book)) return false;
        if ($book->published_at) {
            $book->published_at = Carbon::parse($book->published_at)->format('Y-m-d');
        }
        return $book;
    }

    /**
     * Function update book
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int $book_id
     * @param array $data
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

        try {
            $bookUpdated = $this->bookRepository->update($book_id, $data);
            if ($bookUpdated) {
                return [
                    'status' => true,
                    'message' => 'Update book successfully.'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Update book unsuccessfully. Please check again.'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error updating book: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }

    /**
     * Function delete book
     * Created at: 06/07/2024
     * Created by: Ngân
     * 
     * @param int $book_id
     * @return array
     */
    public function delete($book_id = 0)
    {
        try {
            $bookDeleted = $this->bookRepository->delete($book_id);
            if ($bookDeleted) {
                return [
                    'status' => true,
                    'message' => 'Delete book successfully.'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Delete book unsuccessfully. Please check again.'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error deleting book: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'A system error has occurred. Please check logs.'
            ];
        }
    }
}
