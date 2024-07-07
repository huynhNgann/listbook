<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Author\CreateRequest;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['authors'] = $this->authorService->getAllHavePaginate();
        return view('author.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $inputs = $request->all();
        $author= $this->authorService->create($inputs);
        if ($author['status']) {
            return redirect()->route('author.index')->with('success', $author['message']);
        }
        return back()->with('error', $author['message']);
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author= $this->authorService->getAllAuthor()->find($id);
        return view('author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $find = $this->authorService->find($id);
        if ($find['status']) {
            $data['author'] = $find['author'];
            return view('author.edit', $data);
        }
        return redirect()->route('author.index')->with('error', $find['message']);
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
        $updateResult = $this->authorService->update($id, $inputs);
        if ($updateResult['status']) {
            return redirect()->route('author.index')->with('success', $updateResult['message']);
        }
        return back()->with('error', $updateResult['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $author = $this->authorService->delete($id);
        return redirect()->route('author.index')
            ->with('success', 'Author deleted successfully');
    }
}


