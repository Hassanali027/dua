@extends('admin.layouts.app')

@section('content')
<div class="settings-container">
    <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 class="header-title">Colors</h2>
            <p class="header-subtitle">Manage all color options for your products.</p>
        </div>
        <div>
            <a href="{{ route('admin.color.create') }}" class="btn btn-primary" style="text-decoration: none;">Add New Color</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="settings-card">
        <h3 style="margin-bottom: 20px; font-size: 18px;">All Colors</h3>
        
        @if($colors->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <th style="padding: 12px; font-weight: 600; color: #374151;">ID</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Name</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($colors as $color)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 12px;">{{ $color->id }}</td>
                                <td style="padding: 12px; font-weight: 500;">
                                    {{ $color->name }}
                                </td>
                                <td style="padding: 12px;">
                                    <form action="{{ route('admin.color.destroy', $color->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this color?');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: #dc2626; cursor: pointer; font-weight: 500; font-size: 14px; text-decoration: underline;">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p style="color: #6b7280; font-size: 14px;">No colors found. Click "Add New Color" to create one.</p>
        @endif
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
    .alert-success {
        background-color: #def7ec;
        color: #03543f;
        border: 1px solid #84e1bc;
    }
</style>
@endsection
