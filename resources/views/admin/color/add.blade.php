@extends('admin.layouts.app')

@section('content')
<div class="settings-container">
    <div class="header-section" style="margin-bottom: 30px;">
        <h2 class="header-title">Add New Color</h2>
        <p class="header-subtitle">Add a new color option for your products.</p>
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
        <form action="{{ route('admin.color.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">Color Name <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="e.g. Red, Blue, Green" value="{{ old('name') }}">
            </div>

            <div class="form-actions" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary">Save Color</button>
                <a href="{{ route('admin.color.index') }}" class="btn btn-secondary" style="margin-left: 10px; text-decoration: none; display: inline-block;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    .settings-container {
        max-width: 600px;
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
