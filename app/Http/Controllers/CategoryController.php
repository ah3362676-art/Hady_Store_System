<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {}

    public function index()
    {
        $categories = $this->categoryService->getAll();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', __('messages.category_created_successfully'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category, $request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', __('messages.category_updated_successfully'));
    }

    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return redirect()
            ->route('categories.index')
            ->with('success', __('messages.category_deleted_successfully'));
    }
}
