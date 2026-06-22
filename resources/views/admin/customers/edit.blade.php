@extends('admin.layouts.app')

@section('content')
<div class="settings-container">
    <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 class="header-title">Edit Customer</h2>
            <p class="header-subtitle">Update customer details.</p>
        </div>
        <div>
            <a href="{{ route('admin.customers.index') }}" class="btn" style="background-color: #f3f4f6; color: #374151; text-decoration: none;">Back to Customers</a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert" style="background-color: #fde8e8; color: #9b1c1c; border: 1px solid #f8b4b4;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="settings-card">
        <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px;">Name <span style="color: #dc2626;">*</span></label>
                <input type="text" name="name" value="{{ old('name', $customer->name) }}" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px;">Email Address <span style="color: #dc2626;">*</span></label>
                <input type="email" name="email" value="{{ old('email', $customer->email) }}" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 8px;">Password</label>
                <input type="password" name="password" placeholder="Leave blank to keep current password" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
                <p style="font-size: 12px; color: #6b7280; margin-top: 5px;">Must be at least 8 characters if changing.</p>
            </div>

            <div style="text-align: right; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">Update Customer</button>
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
</style>
@endsection
