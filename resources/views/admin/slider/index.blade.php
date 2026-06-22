@extends('admin.layouts.app')

@section('content')
<div class="settings-container">
    <div class="header-section">
        <h2 class="header-title">Home Page Slider</h2>
        <p class="header-subtitle">Manage the dynamic slider images on your homepage.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="settings-card" style="margin-bottom: 30px;">
        <h3 style="margin-bottom: 15px; font-size: 18px;">Home Page SEO Settings</h3>
        <p style="color: #6b7280; font-size: 13px; margin-bottom: 20px;">
            Set the Meta Title and Description for your website's home page. This improves search engine ranking.
        </p>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="site_title">Home Page Meta Title (SEO Title)</label>
                <input type="text" id="site_title" name="site_title" class="form-control" value="{{ \App\Models\Setting::get('site_title', 'Dua Mehrama') }}" required>
            </div>

            <div class="form-group">
                <label for="site_description">Home Page Meta Description</label>
                <textarea id="site_description" name="site_description" class="form-control" rows="3">{{ \App\Models\Setting::get('site_description', '') }}</textarea>
            </div>

            <div class="form-actions" style="margin-top: 15px; padding-top: 0; border: none; justify-content: flex-start;">
                <button type="submit" class="btn btn-primary">Save SEO Settings</button>
            </div>
        </form>
    </div>

    <div class="settings-card" style="margin-bottom: 30px;">
        <h3 style="margin-bottom: 15px; font-size: 18px;">Add New Slider Image</h3>
        <p style="color: #6b7280; font-size: 13px; margin-bottom: 20px;">
            <strong>Recommended Size:</strong> 1920x820 pixels. Please use a high-quality, wide cinematic image.
        </p>

        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="image">Upload Image</label>
                <input type="file" id="image" name="image" class="form-control" required accept="image/*">
            </div>

            <div class="form-actions" style="margin-top: 15px; padding-top: 0; border: none; justify-content: flex-start;">
                <button type="submit" class="btn btn-primary">Upload Image</button>
            </div>
        </form>
    </div>

    <!-- CTA Banner Section -->
    <div class="settings-card" style="margin-bottom: 30px;">
        <h3 style="margin-bottom: 15px; font-size: 18px;">Update CTA Banner</h3>
        <p style="color: #6b7280; font-size: 13px; margin-bottom: 20px;">
            <strong>Recommended Image Size:</strong> 1440x615 pixels. Please upload an image with this exact or similar aspect ratio.
        </p>

        <form action="{{ route('admin.cta.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="cta_image">Banner Image</label>
                <input type="file" id="cta_image" name="cta_image" class="form-control" accept="image/*">
                @if(\App\Models\Setting::get('cta_image'))
                    <div style="margin-top: 15px;">
                        <p style="font-size: 13px; color: #6b7280; margin-bottom: 5px;">Current Image:</p>
                        <img src="{{ asset(\App\Models\Setting::get('cta_image')) }}" alt="Current CTA Banner" style="max-width: 400px; border-radius: 6px; border: 1px solid #e5e7eb;">
                    </div>
                @else
                    <div style="margin-top: 15px;">
                        <p style="font-size: 13px; color: #6b7280; margin-bottom: 5px;">Current Image:</p>
                        <img src="{{ asset('images/Dua-mahrama-cta banner.webp') }}" alt="Current CTA Banner" style="max-width: 400px; border-radius: 6px; border: 1px solid #e5e7eb;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="cta_link">Banner Link</label>
                <input type="text" id="cta_link" name="cta_link" class="form-control" value="{{ \App\Models\Setting::get('cta_link', '#') }}" placeholder="/category/...">
                <small class="form-text">The URL where the user is redirected when they click the banner.</small>
            </div>

            <div class="form-actions" style="margin-top: 15px; padding-top: 0; border: none; justify-content: flex-start;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <div class="settings-card" style="margin-bottom: 30px;">
        <h3 style="margin-bottom: 15px; font-size: 18px;">Update Bridal Banner</h3>
        <p style="color: #6b7280; font-size: 13px; margin-bottom: 20px;">
            <strong>Recommended Aspect Ratio:</strong> 2:3 (Portrait). Please upload a high-quality vertical image.
        </p>

        <form action="{{ route('admin.bridal.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="bridal_image">Bridal Banner Image</label>
                <input type="file" id="bridal_image" name="bridal_image" class="form-control" accept="image/*">
                @if(\App\Models\Setting::get('bridal_image'))
                    <div style="margin-top: 15px;">
                        <p style="font-size: 13px; color: #6b7280; margin-bottom: 5px;">Current Image:</p>
                        <img src="{{ asset(\App\Models\Setting::get('bridal_image')) }}" alt="Current Bridal Banner" style="max-height: 300px; border-radius: 6px; border: 1px solid #e5e7eb;">
                    </div>
                @else
                    <div style="margin-top: 15px;">
                        <p style="font-size: 13px; color: #6b7280; margin-bottom: 5px;">Current Image:</p>
                        <img src="{{ asset('images/due-bride-hero.webp') }}" alt="Current Bridal Banner" style="max-height: 300px; border-radius: 6px; border: 1px solid #e5e7eb;">
                    </div>
                @endif
            </div>

            <div class="form-actions" style="margin-top: 15px; padding-top: 0; border: none; justify-content: flex-start;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <div class="settings-card" style="margin-bottom: 30px;">
        <h3 style="margin-bottom: 15px; font-size: 18px;">Update Kidswear Collection Section</h3>
        <p style="color: #6b7280; font-size: 13px; margin-bottom: 20px;">
            Update the text and image for the Kidswear section on the homepage.
        </p>

        <form action="{{ route('admin.kids.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label for="kids_heading">Heading</label>
                    <input type="text" id="kids_heading" name="kids_heading" class="form-control" value="{{ \App\Models\Setting::get('kids_heading', 'Kidswear Collection') }}">
                </div>
                <div style="flex: 1;">
                    <label for="kids_link">View All Link</label>
                    <input type="text" id="kids_link" name="kids_link" class="form-control" value="{{ \App\Models\Setting::get('kids_link', '#') }}" placeholder="/category/...">
                </div>
            </div>

            <div class="form-group">
                <label for="kids_desc">Description</label>
                <textarea id="kids_desc" name="kids_desc" class="form-control" rows="2">{{ \App\Models\Setting::get('kids_desc', 'Soft fabrics, playful designs, and everyday comfort come together in our collection for every little adventure.') }}</textarea>
            </div>

            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label for="kids_overlay_text">Image Overlay Text</label>
                    <input type="text" id="kids_overlay_text" name="kids_overlay_text" class="form-control" value="{{ \App\Models\Setting::get('kids_overlay_text', 'PROJECT MASTANI') }}">
                </div>
                <div style="flex: 1;">
                    <label for="kids_btn_text">Image Overlay Button Text</label>
                    <input type="text" id="kids_btn_text" name="kids_btn_text" class="form-control" value="{{ \App\Models\Setting::get('kids_btn_text', 'Party Wear') }}">
                </div>
                <div style="flex: 1;">
                    <label for="kids_btn_link">Image Overlay Button Link</label>
                    <input type="text" id="kids_btn_link" name="kids_btn_link" class="form-control" value="{{ \App\Models\Setting::get('kids_btn_link', '#') }}" placeholder="/category/...">
                </div>
            </div>

            <div class="form-group" style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 45%;">
                    <label for="kids_image_1">Kidswear Image 1</label>
                    <input type="file" id="kids_image_1" name="kids_image_1" class="form-control" accept="image/*">
                    @if(\App\Models\Setting::get('kids_image_1'))
                        <div style="margin-top: 15px;">
                            <img src="{{ asset(\App\Models\Setting::get('kids_image_1')) }}" alt="Kidswear 1" style="max-height: 100px; border-radius: 6px; border: 1px solid #e5e7eb;">
                        </div>
                    @endif
                </div>
                <div style="flex: 1; min-width: 45%;">
                    <label for="kids_image_2">Kidswear Image 2</label>
                    <input type="file" id="kids_image_2" name="kids_image_2" class="form-control" accept="image/*">
                    @if(\App\Models\Setting::get('kids_image_2'))
                        <div style="margin-top: 15px;">
                            <img src="{{ asset(\App\Models\Setting::get('kids_image_2')) }}" alt="Kidswear 2" style="max-height: 100px; border-radius: 6px; border: 1px solid #e5e7eb;">
                        </div>
                    @endif
                </div>
                <div style="flex: 1; min-width: 45%;">
                    <label for="kids_image_3">Kidswear Image 3</label>
                    <input type="file" id="kids_image_3" name="kids_image_3" class="form-control" accept="image/*">
                    @if(\App\Models\Setting::get('kids_image_3'))
                        <div style="margin-top: 15px;">
                            <img src="{{ asset(\App\Models\Setting::get('kids_image_3')) }}" alt="Kidswear 3" style="max-height: 100px; border-radius: 6px; border: 1px solid #e5e7eb;">
                        </div>
                    @endif
                </div>
                <div style="flex: 1; min-width: 45%;">
                    <label for="kids_image_4">Kidswear Image 4</label>
                    <input type="file" id="kids_image_4" name="kids_image_4" class="form-control" accept="image/*">
                    @if(\App\Models\Setting::get('kids_image_4'))
                        <div style="margin-top: 15px;">
                            <img src="{{ asset(\App\Models\Setting::get('kids_image_4')) }}" alt="Kidswear 4" style="max-height: 100px; border-radius: 6px; border: 1px solid #e5e7eb;">
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-actions" style="margin-top: 15px; padding-top: 0; border: none; justify-content: flex-start;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <div class="settings-card">
        <h3 style="margin-bottom: 20px; font-size: 18px;">Current Sliders</h3>
        
        @if($sliders->count() > 0)
            <div class="slider-grid">
                @foreach($sliders as $slider)
                    <div class="slider-item">
                        <img src="{{ asset($slider->image_path) }}" alt="Slider Image">
                        <div class="slider-item-actions" style="display: flex; justify-content: space-between; align-items: center;">
                            <!-- Edit Form -->
                            <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" id="edit-form-{{ $slider->id }}">
                                @csrf
                                <input type="file" name="image" id="edit-image-{{ $slider->id }}" style="display: none;" accept="image/*" onchange="document.getElementById('edit-form-{{ $slider->id }}').submit();">
                                <button type="button" class="btn-edit" onclick="document.getElementById('edit-image-{{ $slider->id }}').click();" style="background: none; border: none; color: #4b5563; cursor: pointer; display: flex; align-items: center; gap: 5px; font-weight: 500; font-size: 14px; transition: color 0.2s;">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </button>
                            </form>

                            <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this slider?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: #6b7280; font-size: 14px;">No sliders added yet. Upload an image above to get started!</p>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .settings-container {
        max-width: 1000px;
        margin: 0 auto;
    }
    .header-section {
        margin-bottom: 30px;
    }
    .header-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 5px;
    }
    .header-subtitle {
        color: #6b7280;
        font-size: 14px;
    }
    .settings-card {
        background: #fff;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
    }
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.2s;
        font-family: 'Poppins', sans-serif;
    }
    .form-control:focus {
        outline: none;
        border-color: #1a1a1a;
        box-shadow: 0 0 0 2px rgba(26, 26, 26, 0.1);
    }
    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        border: none;
        transition: all 0.2s;
    }
    .btn-primary {
        background-color: #1a1a1a;
        color: #fff;
    }
    .btn-primary:hover {
        background-color: #000;
    }
    .alert {
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    .alert-success {
        background-color: #def7ec;
        color: #03543f;
        border: 1px solid #84e1bc;
    }
    .alert-danger {
        background-color: #fde8e8;
        color: #9b1c1c;
        border: 1px solid #f8b4b4;
    }
    
    /* Grid for sliders */
    .slider-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .slider-item {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        background: #f9fafb;
    }
    .slider-item img {
        width: 100%;
        aspect-ratio: 21 / 9;
        object-fit: cover;
        display: block;
    }
    .slider-item-actions {
        padding: 12px;
        display: flex;
        justify-content: flex-end;
        border-top: 1px solid #e5e7eb;
    }
    .btn-delete {
        background: none;
        border: none;
        color: #dc2626;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: 500;
        font-size: 14px;
        transition: color 0.2s;
    }
    .btn-delete:hover {
        color: #991b1b;
    }
</style>
@endsection
