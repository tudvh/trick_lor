<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $page = 'categories';
        $categories = Category::orderBy('id', 'desc')->paginate(20);

        return view('pages.admin.categories.index', compact('page', 'categories'));
    }

    public function create()
    {
        $page = 'categories';

        return view('pages.admin.categories.create', compact('page'));
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'name' => trim($request->name),
            'slug' => str()->slug(trim($request->name)),
            'icon' => $request->icon,
            'icon_color' => $request->icon_color,
        ]);

        return redirect()->route('admin.categories.index')->with("success", "Thêm danh mục thành công!");
    }

    public function edit(Category $category)
    {
        $page = 'categories';

        return view('pages.admin.categories.edit', compact('page', 'category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => trim($request->name),
            'slug' => str()->slug(trim($request->name)),
            'icon' => $request->icon,
            'icon_color' => $request->icon_color,
        ]);

        return redirect()->back()->with("success", "Cập nhật bài đăng thành công!");
    }
}
