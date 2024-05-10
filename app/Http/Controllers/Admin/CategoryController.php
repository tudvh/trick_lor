<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
        $this->middleware('admin');
    }

    public function index()
    {
        $categories = $this->categoryService->getList();
        return view('pages.admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.admin.categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $this->categoryService->setRequest($request)->create();
        return redirect()->route('admin.categories.index')->with("success", "Thêm danh mục thành công!");
    }

    public function edit(Category $category)
    {
        return view('pages.admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->setRequest($request)->update($category);
        return redirect()->back()->with("success", "Cập nhật danh mục thành công!");
    }
}
