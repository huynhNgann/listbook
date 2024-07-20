<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Book\CreateRequest;
use App\Services\BookService;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $author=$this->bookService->getByAuthor();
        $books = $this->bookService->getAllBook(); 
        // $data['books'] = $this->bookService->getAllHavePaginate();
        return view('book.index', compact('books'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $author=$this->bookService->getAllAuthors();
       $category=$this->bookService->getAllCategories(); 
       $books = $this->bookService->getAllBook(); 
       // $category=$this->bookService->getAllCategories();
        return view('book.create',compact('books','author','category'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $inputs = $request->all();
        $book = $this->bookService->create($inputs);
        if ($book['status']) {
           return redirect()->route('book.index')->with('success', $book['message']);
         }
         return back()->with('error', $book['message']);
   //   dd($inputs);
    }
    public function edit(int $id)
    {
        $find = $this->bookService->find($id);
        if ($find['status']) {
            $data['book'] = $find['book'];
            return view('book.edit', $data,compact('author','category'));
        }
        return redirect()->route('book.index')->with('error', $find['message']);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, $id)
    {
        $inputs = $request->all();
        // $author = $this->authorService->find($id);
        // if (!$author) {
        //     return back()->with('error', 'Author not found.');
        // }
        // Cập nhật thông tin của author
        $updateResult = $this->bookService->update($id, $inputs);
        if ($updateResult['status']) {
            return redirect()->route('book.index')->with('success', $updateResult['message']);
        }
        return back()->with('error', $updateResult['message']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $author = $this->bookService->delete($id);
        return redirect()->route('book.index')
            ->with('success', 'Book deleted successfully');
    }
}


