<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        // Get per_page from request, default to 10, and limit max to 100
        $perPage = $request->query('per_page', 10);
        $perPage = is_numeric($perPage) && $perPage > 0 ? min($perPage, 100) : 10;

        // Get the search term from the request (if exists)
        $search = $request->query('search');

        // Query to get subCategories
        $query = SubCategory::with('category')->latest();

        // If there's a search term, filter the subCategories by name
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        }

        // Get the subCategories with pagination
        $subCategories = $query->paginate($perPage);

        return view('Pages.subcategory', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Pages.Create.createSubCategory', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name|string|max:255',
            'category' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'note' => 'nullable|string|max:1000',
        ]);

        $slug = Str::slug($request->input('name'));
        SubCategory::create([
            'name' => $request->input('name'),
            'cat_id' => $request->input('category'),
            'status' => ($request->input('status') == 'active') ? true : false,
            'note' => $request->input('note'),
            'slug' => $slug,
        ]);

        return redirect()->route('subcategory')->with('success', 'Sub Category added successfully! ');
    }
    public function edit($id)
    {
        $categories = Category::all();
        $subCategory = SubCategory::find($id);
        if (!$subCategory) {
            return redirect()->route('subcategory')->with('error', 'The Sub Category does not exists!');
        }
        return view('Pages.Edits.editSubCategory', compact('categories', 'subCategory'));
    }
    public function update(Request $request, $id)
    {

        $subCategory = SubCategory::find($id);
        if (!$subCategory) {
            return redirect()->route('subcategory')->with('error', 'Cannot update the Sub Category!');
        }

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories', 'name')->ignore($subCategory->id),
            ],
            'category' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'note' => 'nullable|string|max:1000',
        ]);

        $slug = Str::slug($request->input('name'));
        $subCategory->update([
            'name' => $request->input('name'),
            'cat_id' => $request->input('category'),
            'status' => ($request->input('status') == 'active') ? true : false,
            'note' => $request->input('note'),
            'slug' => $slug,
        ]);

        return redirect()->route('subcategory')->with('success', 'Sub Category updated successfully! ');
    }

    public function destroy(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);
        if (!$subCategory) {
            return redirect()->route('subcategory')->with('error', 'Cannot delete the Sub Category');
        }
        $subCategory->delete();
        return redirect()->route('subcategory')->with('success', 'The Sub Category deleted successfully!');
    }
}
