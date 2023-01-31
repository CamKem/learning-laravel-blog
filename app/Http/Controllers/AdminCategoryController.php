<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $attribute = request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = new Category();
        $category->save($attribute);

        return redirect()->back()->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        ddd($category);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Category $category)
    {
        $attribute = request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category->update($attribute);

        return redirect()->back()->with('success', 'Category updated successfully');
    }

}
