<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $mainCategories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.category.add', compact('mainCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->show_in_navbar = $request->has('show_in_navbar') ? 1 : 0;
        $category->parent_id = $request->parent_id;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/categories'), $imageName);
            $category->image_path = 'images/categories/' . $imageName;
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $mainCategories = Category::with('children')->whereNull('parent_id')->where('id', '!=', $id)->get();
        return view('admin.category.edit', compact('category', 'mainCategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $id,
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->show_in_navbar = $request->has('show_in_navbar') ? 1 : 0;
        $category->parent_id = $request->parent_id;

        if ($request->hasFile('image_path')) {
            // Delete old image
            if ($category->image_path && file_exists(public_path($category->image_path))) {
                unlink(public_path($category->image_path));
            }
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/categories'), $imageName);
            $category->image_path = 'images/categories/' . $imageName;
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->image_path && file_exists(public_path($category->image_path))) {
            unlink(public_path($category->image_path));
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully!');
    }
}
