<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order', 'asc')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Move to public/images/sliders directory
            $file->move(public_path('images/sliders'), $filename);

            Slider::create([
                'image_path' => 'images/sliders/' . $filename,
                'order' => Slider::count() + 1
            ]);
        }

        return redirect()->back()->with('success', 'Slider image added successfully!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        
        // Remove file
        $imagePath = public_path($slider->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $slider->delete();

        return redirect()->back()->with('success', 'Slider image deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $slider = Slider::findOrFail($id);

        if ($request->hasFile('image')) {
            // Remove old file
            $oldImagePath = public_path($slider->image_path);
            if (file_exists($oldImagePath) && !is_dir($oldImagePath)) {
                unlink($oldImagePath);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/sliders'), $filename);

            $slider->update([
                'image_path' => 'images/sliders/' . $filename,
            ]);
        }

        return redirect()->back()->with('success', 'Slider image updated successfully!');
    }

    public function updateCta(Request $request)
    {
        $request->validate([
            'cta_link' => 'nullable|string',
            'cta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('cta_image')) {
            $file = $request->file('cta_image');
            $filename = time() . '_cta_' . $file->getClientOriginalName();
            $file->move(public_path('images/cta'), $filename);

            \App\Models\Setting::updateOrCreate(
                ['key' => 'cta_image'],
                ['value' => 'images/cta/' . $filename]
            );
        }

        if ($request->has('cta_link')) {
            \App\Models\Setting::updateOrCreate(
                ['key' => 'cta_link'],
                ['value' => $request->cta_link]
            );
        }

        return redirect()->back()->with('success', 'CTA Banner updated successfully!');
    }

    public function updateBridal(Request $request)
    {
        $request->validate([
            'bridal_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('bridal_image')) {
            $file = $request->file('bridal_image');
            $filename = time() . '_bridal_' . $file->getClientOriginalName();
            $file->move(public_path('images/cta'), $filename); // reuse cta folder or sliders

            \App\Models\Setting::updateOrCreate(
                ['key' => 'bridal_image'],
                ['value' => 'images/cta/' . $filename]
            );
        }

        return redirect()->back()->with('success', 'Bridal Banner updated successfully!');
    }

    public function updateKids(Request $request)
    {
        $request->validate([
            'kids_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'kids_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'kids_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'kids_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'kids_heading' => 'nullable|string|max:255',
            'kids_desc' => 'nullable|string',
            'kids_link' => 'nullable|string',
            'kids_overlay_text' => 'nullable|string|max:255',
            'kids_btn_text' => 'nullable|string|max:255',
            'kids_btn_link' => 'nullable|string',
        ]);

        $imageFields = ['kids_image_1', 'kids_image_2', 'kids_image_3', 'kids_image_4'];
        foreach ($imageFields as $imgField) {
            if ($request->hasFile($imgField)) {
                $file = $request->file($imgField);
                $filename = time() . '_' . $imgField . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/cta'), $filename); 

                \App\Models\Setting::updateOrCreate(
                    ['key' => $imgField],
                    ['value' => 'images/cta/' . $filename]
                );
            }
        }

        $fields = ['kids_heading', 'kids_desc', 'kids_link', 'kids_overlay_text', 'kids_btn_text', 'kids_btn_link'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                \App\Models\Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $request->$field]
                );
            }
        }

        return redirect()->back()->with('success', 'Kidswear Section updated successfully!');
    }
}
