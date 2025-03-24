<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Get per_page from request, default to 10, and limit max to 100
        $perPage = $request->query('per_page', 10);
        $perPage = is_numeric($perPage) && $perPage > 0 ? min($perPage, 100) : 10;

        // Get the search term from the request (if exists)
        $search = $request->query('search');

        // Query to get categories
        $query = Category::latest();

        // If there's a search term, filter the categories by name
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Get the categories with pagination
        $categories = $query->paginate($perPage);

        return view('Pages.category', compact('categories'));
    }


    public function create()
    {
        return view('Pages.Create.createCategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            'status' => 'required|in:active,inactive',
            'note' => 'nullable|string|max:1000',
        ]);
        $slug = Str::slug($request->input('name'));
        Category::create([
            'name' => $request->input('name'),
            'status' => ($request->input('status') == 'active') ? true : false,
            'note' => $request->input('note'),
            'slug' => $slug,
        ]);
        return redirect()->route('category')->with('success', 'Category added successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category')->with('error', 'The Category does not exists');
        }
        return view('Pages.Edits.editCategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
            'status' => 'required|in:active,inactive',
            'note' => 'nullable|string|max:1000',
        ]);
        $slug = Str::slug($request->input('name'));
        if (!$category) {
            return redirect()->back()->with('error', 'Cannot update the category');
        }
        $category->update([
            'name' => $request->input('name'),
            'status' => ($request->input('status') == 'active') ? true : false,
            'note' => $request->input('note'),
            'slug' => $slug,
        ]);
        return redirect()->route('category')->with('success', 'Category updated successfully');
    }
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category')->with('error', 'The Category does not exists');
        }
        $category->delete();
        return redirect()->route('category')->with('success', 'The Category deleted successfully!');
    }
}
