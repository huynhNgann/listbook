<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = $this->categoryService->getAllHavePaginate();
        return view('category.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $inputs = $request->all();
        $category= $this->categoryService->create($inputs);
        if ($category['status']) {
            return redirect()->route('category.index')->with('success', $category['message']);
        }
        return back()->with('error', $category['message']);
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
        $category= $this->categoryService->getAllCategory()->find($id);
        return view('category.show', compact('category'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $find = $this->categoryService->find($id);
        if ($find['status']) {
            $data['category'] = $find['category'];
            return view('category.edit', $data);
        }
        return redirect()->route('category.index')->with('error', $find['message']);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, $id)
    {
        $inputs = $request->all();
        $updateResult = $this->categoryService->update($id, $inputs);
        if ($updateResult['status']) {
            return redirect()->route('category.index')->with('success', $updateResult['message']);
        }
        return back()->with('error', $updateResult['message']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cate= $this->categoryService->delete($id);
        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully');
    }
}


