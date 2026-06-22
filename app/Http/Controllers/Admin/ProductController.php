<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->where(function($q) {
                $q->where('status', 1)->orWhere('status', 'active');
            })
            ->with(['children' => function($q) {
                $q->where('status', 1)->orWhere('status', 'active');
            }])
            ->get();
        $colors = \App\Models\Color::all();
        $allProducts = Product::all();
        return view('admin.product.add', compact('categories', 'colors', 'allProducts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_on_sale' => 'nullable|boolean',
            'sale_price' => 'nullable|numeric|min:0',
            'colors' => 'nullable|array',
            'size' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer|min:0',
            'product_detail' => 'nullable|string',
            'season' => 'nullable|string|max:255',
            'product_details' => 'nullable|string',
            'product_care' => 'nullable|string',
            'shipping' => 'nullable|string',
            'return_exchange' => 'nullable|string',
            'is_most_in_demand' => 'nullable|boolean',
            'is_new_arrival' => 'nullable|boolean',
            'is_bridal_party_wear' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_best_selling' => 'nullable|boolean',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->categories[0]; // fallback backward compatibility
        $product->is_on_sale = $request->has('is_on_sale');
        $product->sale_price = $request->sale_price;
        $product->is_most_in_demand = $request->has('is_most_in_demand');
        $product->is_new_arrival = $request->has('is_new_arrival');
        $product->is_bridal_party_wear = $request->has('is_bridal_party_wear');
        $product->is_featured = $request->has('is_featured');
        $product->is_best_selling = $request->has('is_best_selling');
        $product->show_in_navbar = $request->has('show_in_navbar');
        
        // Handle array of colors from checkboxes
        if ($request->has('colors') && is_array($request->colors)) {
            $product->color = implode(',', $request->colors);
        } else {
            $product->color = null;
        }
        
        // Handle array of sizes
        if ($request->has('sizes') && is_array($request->sizes)) {
            $product->size = implode(', ', $request->sizes);
        } else {
            $product->size = $request->size; // fallback if it comes as string
        }
        $product->quantity = $request->quantity ?? 0;
        $product->product_detail = $request->product_detail;
        $product->season = $request->season;
        $product->product_details = $request->product_details;
        $product->product_care = $request->product_care;
        $product->shipping = $request->shipping;
        $product->return_exchange = $request->return_exchange;
        
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $product->image_path = 'images/products/' . $imageName;
        }

        $product->save();

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        if ($request->has('related_products')) {
            $product->relatedProducts()->sync($request->related_products);
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('images/products/gallery'), $galleryImageName);
                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'images/products/gallery/' . $galleryImageName
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('images', 'relatedProducts', 'categories');
        $categories = Category::whereNull('parent_id')
            ->where(function($q) {
                $q->where('status', 1)->orWhere('status', 'active');
            })
            ->with(['children' => function($q) {
                $q->where('status', 1)->orWhere('status', 'active');
            }])
            ->get();
        $colors = \App\Models\Color::all();
        $allProducts = Product::where('id', '!=', $product->id)->get();
        return view('admin.product.edit', compact('product', 'categories', 'colors', 'allProducts'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_on_sale' => 'nullable|boolean',
            'sale_price' => 'nullable|numeric|min:0',
            'colors' => 'nullable|array',
            'size' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer|min:0',
            'product_detail' => 'nullable|string',
            'season' => 'nullable|string|max:255',
            'product_details' => 'nullable|string',
            'product_care' => 'nullable|string',
            'shipping' => 'nullable|string',
            'return_exchange' => 'nullable|string',
            'is_most_in_demand' => 'nullable|boolean',
            'is_new_arrival' => 'nullable|boolean',
            'is_bridal_party_wear' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_best_selling' => 'nullable|boolean',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->categories[0]; // fallback backward compatibility
        $product->is_on_sale = $request->has('is_on_sale');
        $product->sale_price = $request->sale_price;
        $product->is_most_in_demand = $request->has('is_most_in_demand');
        $product->is_new_arrival = $request->has('is_new_arrival');
        $product->is_bridal_party_wear = $request->has('is_bridal_party_wear');
        $product->is_featured = $request->has('is_featured');
        $product->is_best_selling = $request->has('is_best_selling');
        $product->show_in_navbar = $request->has('show_in_navbar');
        
        if ($request->has('colors') && is_array($request->colors)) {
            $product->color = implode(',', $request->colors);
        } else {
            $product->color = null;
        }
        
        if ($request->has('sizes') && is_array($request->sizes)) {
            $product->size = implode(', ', $request->sizes);
        } else {
            $product->size = $request->size;
        }
        $product->quantity = $request->quantity ?? 0;
        $product->product_detail = $request->product_detail;
        $product->season = $request->season;
        $product->product_details = $request->product_details;
        $product->product_care = $request->product_care;
        $product->shipping = $request->shipping;
        $product->return_exchange = $request->return_exchange;
        
        if ($request->hasFile('image_path')) {
            // Delete old image
            if ($product->image_path && file_exists(public_path($product->image_path))) {
                unlink(public_path($product->image_path));
            }
            $image = $request->file('image_path');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $product->image_path = 'images/products/' . $imageName;
        }

        $product->save();

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        } else {
            $product->categories()->sync([]);
        }

        if ($request->has('related_products')) {
            $product->relatedProducts()->sync($request->related_products);
        } else {
            $product->relatedProducts()->sync([]);
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('images/products/gallery'), $galleryImageName);
                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'images/products/gallery/' . $galleryImageName
                ]);
            }
        }

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path && file_exists(public_path($product->image_path))) {
            unlink(public_path($product->image_path));
        }
        
        foreach($product->images as $img) {
            if (file_exists(public_path($img->image_path))) {
                unlink(public_path($img->image_path));
            }
        }
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }
    public function destroyImage($id)
    {
        $image = \App\Models\ProductImage::findOrFail($id);
        
        if ($image->image_path && file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }
        
        $image->delete();
        
        return response()->json(['success' => true]);
    }
}
