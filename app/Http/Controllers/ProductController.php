<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    protected $units = [
        'Pcs' => 'Piece',
        'Kg' => 'Kilogram',
        'Bundel' => 'Bundel',
        'Pack' => 'Packet',
        'Gm' => 'Gram',
        'Ltr' => 'Litre',
        'Doz' => 'Dozen',
        'Bora' => 'Bora',
    ];
    protected $taxes = [
        '13' => 'Vat@13',
        '20' => 'Vat@20',
        '10' => 'Vat@10',
        '0' => 'Vat@0',
    ];

    public function index(Request $request)
    {
        // Get per_page from request, default to 10, and limit max to 100
        $perPage = $request->query('per_page', 10);
        $perPage = is_numeric($perPage) && $perPage > 0 ? min($perPage, 100) : 10;

        // Get the search term from the request (if exists)
        $search = $request->query('search');

        // Query to get products
        $query = Product::with('subCategory')->latest();

        // If there's a search term, filter the products by name, description, etc.
        if ($search) {
            $query->where('item_name', 'like', '%' . $search . '%')
                ->orWhere('brand', 'like', '%' . $search . '%')
                ->orWhereHas('subCategory', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        }

        // Get the products with pagination
        $products = $query->paginate($perPage);

        return view('Pages.product', compact('products'));
    }

    public function create()
    {

        $lastProduct = Product::orderByDesc('item_code')->first();
        if ($lastProduct) {
            $newCode = str_pad($lastProduct->item_code + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $newCode = '00001'; // If no products exist, start from '00001'
        }
        $units = $this->units;
        $taxes = $this->taxes;
        $subCategories = SubCategory::get();
        return view('Pages.Create.createProduct', compact('subCategories', 'units', 'taxes','newCode'));
    }
    public function store(Request $request)
    {
        $units = array_flip($this->units);
        $taxes = array_flip($this->taxes);
        $request->validate([
            'item_name' => 'required|unique:products,item_name|string|max:255',
            'item_model' => 'nullable|string|max:255',
            'item_code' => 'required|string|max:100|unique:products,item_code',
            'sub_category' => 'required',
            'brand' => 'nullable|string|max:255',
            'unit' => ['required', Rule::in($units)], // Use the units array dynamically
            'tax' => ['required', Rule::in($taxes)], // Use the taxes array dynamically
            'tax_type' => 'required|in:exclusive,inclusive',
            'regular_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'selling_price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'note' => 'nullable|string|max:1000',
            'voice_tags' => 'nullable|string|max:1000',
        ]);
        $slug = Str::slug($request->input('item_name'));
        $imagePath = null;
        if ($request->has('image')) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $slug . '_' . time() . '.' . $ext;
            $imagePath = $image->storeAs('images/products', $imageName, 'public');
        }


        // Convert voice_tags string to JSON array
        $voiceTags = $request->input('voice_tags');
        if ($voiceTags) {
            // Assuming voice_tags is a comma-separated string like "tag1,tag2,tag3"
            $tagsArray = array_filter(explode(',', $voiceTags)); // Split by comma and remove empty values
            $voiceTags = json_encode($tagsArray); // Convert to JSON
        } else {
            $voiceTags = null; // Store null if empty
        }


        Product::create([
            'item_name' => $request->input('item_name'),
            'slug' => $slug,
            'item_model' => $request->input('item_model'),
            'item_code' => $request->input('item_code'),
            'sub_cat_id' => $request->input('sub_category'),
            'brand' => $request->input('brand'),
            'unit' => $request->input('unit'),
            'tax' => $request->input('tax'),
            'tax_type' => $request->input('tax_type'),
            'regular_price' => $request->input('regular_price'),
            'discount' => $request->input('discount'),
            'selling_price' => $request->input('selling_price'),
            'status' => ($request->input('status') == 'active') ? true : false,
            'note' => $request->input('note'),
            'voice_tags' => $voiceTags,
            'image_path' => $imagePath,
        ]);
        return redirect()->route('product')->with('success', 'Product added Successfully!');
    }

    public function edit($id)
    {
        $subCategories = SubCategory::get();
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product')->with('error', 'Cannot find the product');
        }
        $units = $this->units;
        $taxes = $this->taxes;
        return view('Pages.Edits.editProduct', compact('subCategories', 'product', 'units', 'taxes'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product')->with('error', 'Cannot find the product');
        }
        $units = array_flip($this->units);
        $taxes = array_flip($this->taxes);

        // Validation
        $request->validate([
            'item_name' => ['required', 'string', 'max:100', Rule::unique('products', 'item_name')->ignore($product->id)],
            'item_code' => ['required', 'string', 'max:100', Rule::unique('products', 'item_code')->ignore($product->id)],
            'item_model' => 'nullable|string|max:255',
            'sub_category' => 'required',
            'brand' => 'nullable|string|max:255',
            'unit' => ['required', Rule::in($units)], // Use the units array dynamically
            'tax' => ['required', Rule::in($taxes)], // Use the taxes array dynamically
            'tax_type' => 'required|in:exclusive,inclusive',
            'regular_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'selling_price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'note' => 'nullable|string|max:1000',
            'voice_tags' => 'nullable|string|max:1000',
        ]);

        // Generate slug
        $slug = Str::slug($request->input('item_name'));

        // Handle image upload (only if a new image is provided)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = $slug . '_' . time() . '.' . $ext;
            $imagePath = $image->storeAs('images/products', $imageName, 'public');

            // Delete old image if it exists
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $product->image_path = $imagePath;
        }

        // Convert voice_tags string to JSON array
        $voiceTags = $request->input('voice_tags');
        if ($voiceTags) {
            $tagsArray = array_filter(explode(',', $voiceTags)); // Split by comma and remove empty values
            $voiceTags = json_encode($tagsArray); // Convert to JSON
        } else {
            $voiceTags = null;
        }

        // Update the product
        $product->update([
            'item_name' => $request->input('item_name'),
            'slug' => $slug,
            'item_model' => $request->input('item_model'),
            'item_code' => $request->input('item_code'),
            'sub_cat_id' => $request->input('sub_category'),
            'brand' => $request->input('brand'),
            'unit' => $request->input('unit'),
            'tax' => $request->input('tax'),
            'tax_type' => $request->input('tax_type'),
            'regular_price' => $request->input('regular_price'),
            'discount' => $request->input('discount'),
            'selling_price' => $request->input('selling_price'),
            'status' => ($request->input('status') == 'active'),
            'note' => $request->input('note'),
            'voice_tags' => $voiceTags,
        ]);

        return redirect()->route('product')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product')->with('error', 'Cannot delete the product');
        }
        $product->delete();
        return redirect()->route('product')->with('success', 'The product deleted successfully');
    }
}
