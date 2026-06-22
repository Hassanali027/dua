@extends('admin.layouts.app')

@section('content')
<div class="settings-container">
    <div class="header-section">
        <h2 class="header-title">Topbar Settings</h2>
        <p class="header-subtitle">Manage topbar content and social links</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="settings-card">
        <form action="{{ route('admin.topbar.update') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="topbar_text">Topbar Text</label>
                <input type="text" id="topbar_text" name="topbar_text" class="form-control" value="{{ \App\Models\Setting::get('topbar_text', 'Free Delivery on Orders Above Rs. 3000 ✨') }}">
                <small class="form-text">This text appears at the very top of the website.</small>
            </div>

            <div class="form-group">
                <label for="instagram_link">Instagram Link</label>
                <input type="url" id="instagram_link" name="instagram_link" class="form-control" value="{{ \App\Models\Setting::get('instagram_link', '#') }}" placeholder="https://instagram.com/yourprofile">
                <small class="form-text">Link for the Instagram button in the topbar.</small>
            </div>

            <div class="form-group">
                <label for="facebook_link">Facebook Link</label>
                <input type="url" id="facebook_link" name="facebook_link" class="form-control" value="{{ \App\Models\Setting::get('facebook_link', '#') }}" placeholder="https://facebook.com/yourprofile">
                <small class="form-text">Link for the Facebook button in the topbar.</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
    .form-text {
        display: block;
        margin-top: 5px;
        color: #6b7280;
        font-size: 12px;
    }
    .form-actions {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
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
</style>
@endsection
