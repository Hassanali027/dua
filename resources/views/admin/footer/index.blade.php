@extends('admin.layouts.app')

@section('content')
<div class="settings-container">
    <div class="header-section">
        <h2 class="header-title">Footer Settings</h2>
        <p class="header-subtitle">Manage the information displayed at the bottom of the website.</p>
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

    <form action="{{ route('admin.footer.update') }}" method="POST">
        @csrf
        
        <!-- Brand Section -->
        <div class="settings-card">
            <h3 style="margin-bottom: 20px; font-size: 18px; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px;">Brand Information</h3>
            
            <div class="form-group">
                <label for="footer_text">Footer Brand Text</label>
                <textarea id="footer_text" name="footer_text" class="form-control" rows="3" placeholder="We have clothes that suits your style...">{{ \App\Models\Setting::get('footer_text', "We have clothes that suits your\nstyle and which you're proud to\nwear. From girl to boy.") }}</textarea>
                <small class="form-text">The text displayed directly below the logo.</small>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="settings-card">
            <h3 style="margin-bottom: 20px; font-size: 18px; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px;">Social Media Links</h3>
            
            <div class="grid-form">
                <div class="form-group">
                    <label for="footer_twitter">Twitter Link</label>
                    <input type="text" id="footer_twitter" name="footer_twitter" class="form-control" value="{{ \App\Models\Setting::get('footer_twitter', '#') }}">
                </div>
                
                <div class="form-group">
                    <label for="footer_facebook">Facebook Link</label>
                    <input type="text" id="footer_facebook" name="footer_facebook" class="form-control" value="{{ \App\Models\Setting::get('footer_facebook', '#') }}">
                </div>

                <div class="form-group">
                    <label for="footer_instagram">Instagram Link</label>
                    <input type="text" id="footer_instagram" name="footer_instagram" class="form-control" value="{{ \App\Models\Setting::get('footer_instagram', '#') }}">
                </div>

                <div class="form-group">
                    <label for="footer_github">GitHub / Other Link</label>
                    <input type="text" id="footer_github" name="footer_github" class="form-control" value="{{ \App\Models\Setting::get('footer_github', '#') }}">
                </div>
            </div>
        </div>

        <!-- Get In Touch -->
        <div class="settings-card">
            <h3 style="margin-bottom: 20px; font-size: 18px; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px;">Get In Touch</h3>
            
            <div class="form-group">
                <label for="footer_address">Address</label>
                <input type="text" id="footer_address" name="footer_address" class="form-control" value="{{ \App\Models\Setting::get('footer_address', 'Plot # 126, Al Noor Industrial Estate 20-KM Ferozpur Road, Asif Town, Lahore') }}">
            </div>

            <div class="grid-form">
                <div class="form-group">
                    <label for="footer_email">Email</label>
                    <input type="email" id="footer_email" name="footer_email" class="form-control" value="{{ \App\Models\Setting::get('footer_email', 'Customercare@example.com.pk') }}">
                </div>

                <div class="form-group">
                    <label for="footer_phone">Phone Number</label>
                    <input type="text" id="footer_phone" name="footer_phone" class="form-control" value="{{ \App\Models\Setting::get('footer_phone', '042-35140496') }}">
                </div>
                
                <div class="form-group" style="grid-column: span 2;">
                    <label for="footer_timing">Working Timings</label>
                    <input type="text" id="footer_timing" name="footer_timing" class="form-control" value="{{ \App\Models\Setting::get('footer_timing', 'Mon - Sat / 10AM - 6PM') }}">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('styles')
<style>
    .settings-container {
        max-width: 900px;
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
        margin-bottom: 25px;
    }
    .grid-form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0 20px;
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
    textarea.form-control {
        resize: vertical;
    }
    .form-text {
        display: block;
        margin-top: 5px;
        color: #6b7280;
        font-size: 12px;
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
    .form-actions {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
    }
</style>
@endsection
