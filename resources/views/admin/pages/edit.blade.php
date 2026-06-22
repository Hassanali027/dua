@extends('admin.layouts.app')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Edit Static Page: {{ $page->name }}</h2>
    <a href="{{ route('admin.pages.index') }}" class="btn-back" style="color: #6b7280; text-decoration: none; font-size: 14px; font-weight: 500;">&larr; Back to Pages</a>
</div>

<div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 30px; max-width: 900px;">
    @if ($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">Page Title (H1) *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px; border-top: 1px solid #eee; padding-top: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">Meta Title (SEO)</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">Meta Description (SEO)</label>
            <textarea name="meta_description" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">{{ old('meta_description', $page->meta_description) }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 500; margin-bottom: 8px;">Page Content *</label>
            <textarea name="content" id="page_content">{{ old('content', $page->content) }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: flex; align-items: center; cursor: pointer; font-weight: 500;">
                <input type="checkbox" name="status" value="1" {{ old('status', $page->status) == '1' ? 'checked' : '' }} style="margin-right: 10px; width: 16px; height: 16px;">
                Active (Visible on frontend)
            </label>
        </div>

        <button type="submit" style="background: #1a1a1a; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: 500; font-size: 14px;">
            Update Page
        </button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#page_content'))
        .catch(error => {
            console.error(error);
        });
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>
@endsection
