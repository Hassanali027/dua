<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('product')->orderBy('created_at', 'desc')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'approved';
        $review->save();

        return redirect()->back()->with('success', 'Review approved successfully.');
    }

    public function destroy($id)
    {
        \Log::info("Attempting to delete review: " . $id);
        $review = Review::findOrFail($id);
        
        foreach ($review->images as $image) {
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
        }
        
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
