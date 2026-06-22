@extends('admin.layouts.app')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Edit Blog Post</h2>
    <a href="{{ route('admin.blog.index') }}" class="btn-back" style="color: #6b7280; text-decoration: none; font-size: 14px; font-weight: 500;">&larr; Back to Blogs</a>
</div>

<div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 30px; max-width: 800px;">
    @if ($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">Blog Title / Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $post->name) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">URL Slug *</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div class="form-row" style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 8px;">Author Name</label>
                <input type="text" name="author_name" value="{{ old('author_name', $post->author_name) }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 500; margin-bottom: 8px;">Author Image</label>
                @if($post->author_image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset($post->author_image) }}" alt="Current Author Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                    </div>
                @endif
                <input type="file" name="author_image" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">Blog Image</label>
            @if($post->image_path)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset($post->image_path) }}" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;">
                </div>
            @endif
            <input type="file" name="image" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
            <small style="color: #888;">Leave empty to keep the current image.</small>
        </div>

        <div style="margin-bottom: 20px; border-top: 1px solid #eee; padding-top: 20px;">
            <h4 style="margin-top: 0; margin-bottom: 15px;">Social Share Links (Optional)</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 8px;">Facebook Link</label>
                    <input type="url" name="facebook_link" value="{{ old('facebook_link', $post->facebook_link) }}" placeholder="https://facebook.com/..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 8px;">Twitter Link</label>
                    <input type="url" name="twitter_link" value="{{ old('twitter_link', $post->twitter_link) }}" placeholder="https://twitter.com/..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 8px;">Instagram Link</label>
                    <input type="url" name="instagram_link" value="{{ old('instagram_link', $post->instagram_link) }}" placeholder="https://instagram.com/..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 8px;">YouTube Link</label>
                    <input type="url" name="youtube_link" value="{{ old('youtube_link', $post->youtube_link) }}" placeholder="https://youtube.com/..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
            </div>
        </div>

        <div style="margin-bottom: 20px; border-top: 1px solid #eee; padding-top: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">Meta Title (SEO)</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">Meta Description (SEO)</label>
            <textarea name="meta_description" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">{{ old('meta_description', $post->meta_description) }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">Long Description (Blog Content)</label>
            <textarea name="long_description" id="long_description">{{ old('long_description', $post->long_description) }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: flex; align-items: center; cursor: pointer; font-weight: 500; margin-bottom: 10px;">
                <input type="checkbox" name="status" value="1" {{ old('status', $post->status) == '1' ? 'checked' : '' }} style="margin-right: 10px; width: 16px; height: 16px;">
                Active (Publish immediately)
            </label>
            <label style="display: flex; align-items: center; cursor: pointer; font-weight: 500;">
                <input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $post->is_popular) == '1' ? 'checked' : '' }} style="margin-right: 10px; width: 16px; height: 16px;">
                Set as Popular Blog (Shows in sidebar)
            </label>
        </div>

        <button type="submit" style="background: #1a1a1a; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: 500; font-size: 14px;">
            Update Blog
        </button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#long_description'))
        .catch(error => {
            console.error(error);
        });
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>
@endsection
