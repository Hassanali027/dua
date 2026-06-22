<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);

        $product = Product::findOrFail($productId);

        $review = Review::create([
            'product_id' => $product->id,
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'status' => 'pending',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/reviews'), $imageName);
                
                \App\Models\ReviewImage::create([
                    'review_id' => $review->id,
                    'image_path' => 'images/reviews/' . $imageName,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Your review has been submitted and is waiting for approval.');
    }
}
