@extends('admin.layouts.app')

@section('content')
<div class="settings-container">
    <div class="header-section" style="margin-bottom: 30px;">
        <h2 class="header-title">Add New Category</h2>
        <p class="header-subtitle">Create a new product category for your store.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="settings-card">
        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name">Category Name <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="e.g. Ready to Wear" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="parent_id">Parent Category (Optional)</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">-- None (Main Category) --</option>
                    @foreach($mainCategories as $cat)
                        <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @foreach($cat->children as $child)
                            <option value="{{ $child->id }}" {{ old('parent_id') == $child->id ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;-- {{ $child->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                <small style="color: #6b7280; font-size: 12px; margin-top: 5px; display: block;">Select a category if you want this to be a subcategory.</small>
            </div>

            <div class="form-group">
                <label for="slug">URL Slug (Optional)</label>
                <input type="text" id="slug" name="slug" class="form-control" placeholder="e.g. ready-to-wear" value="{{ old('slug') }}">
                <small style="color: #6b7280; font-size: 12px; margin-top: 5px; display: block;">Leave empty to auto-generate from name. Only use lowercase letters, numbers, and hyphens.</small>
            </div>

            <div class="form-group">
                <label for="image_path">Category Image</label>
                <input type="file" id="image_path" name="image_path" class="form-control" accept="image/*">
                <small style="color: #6b7280; font-size: 12px; margin-top: 5px; display: block;">Recommended format: JPG, PNG, WEBP. Max size: 2MB.</small>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: flex; align-items: center; cursor: pointer; font-weight: 500;">
                    <input type="checkbox" name="show_in_navbar" value="1" {{ old('show_in_navbar') == '1' ? 'checked' : '' }} style="margin-right: 10px; width: 16px; height: 16px;">
                    Show in Navbar (Display this category in the top navigation menu)
                </label>
            </div>

            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #e5e7eb;">
            <h3 style="font-size: 18px; margin-bottom: 20px;">SEO Settings</h3>

            <div class="form-group">
                <label for="meta_title">Meta Title (SEO)</label>
                <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="e.g. Best Ready to Wear Dresses" value="{{ old('meta_title') }}">
                <small style="color: #6b7280; font-size: 12px; margin-top: 5px; display: block;">Leave empty to use category name.</small>
            </div>

            <div class="form-group">
                <label for="meta_description">Meta Description (SEO)</label>
                <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Brief description for search engines...">{{ old('meta_description') }}</textarea>
            </div>

            <div class="form-actions" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary">Save Category</button>
                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary" style="margin-left: 10px; text-decoration: none; display: inline-block;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    .settings-container {
        max-width: 800px;
        margin: 0 auto;
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
        margin-bottom: 20px;
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
    .btn-secondary {
        background-color: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    .btn-secondary:hover {
        background-color: #e5e7eb;
    }
    .alert {
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    .alert-danger {
        background-color: #fde8e8;
        color: #9b1c1c;
        border: 1px solid #f8b4b4;
    }
</style>
@endsection
