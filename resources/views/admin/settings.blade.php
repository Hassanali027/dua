@extends('admin.layouts.app')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Site Settings</h2>
</div>

<div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 20px; max-width: 600px;">
    @if(session('success'))
        <div style="background: #dcfce3; color: #166534; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 500; font-size: 14px;">Site Title (SEO Title)</label>
            <input type="text" name="site_title" value="{{ old('site_title', $site_title) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
            @error('site_title')
                <div style="color: #dc2626; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
            <small style="color: #888; font-size: 12px; margin-top: 5px; display: block;">This title will appear on the browser tab and Google search results.</small>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 500; font-size: 14px;">Meta Description</label>
            <textarea name="site_description" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">{{ old('site_description', $site_description) }}</textarea>
            @error('site_description')
                <div style="color: #dc2626; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
            <small style="color: #888; font-size: 12px; margin-top: 5px; display: block;">A brief description of your website for search engines.</small>
        </div>

        <button type="submit" style="background: #1a1a1a; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: 500; font-size: 14px;">
            Save Settings
        </button>
    </form>
</div>
@endsection
