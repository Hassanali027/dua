@extends('admin.layouts.app')

@section('content')
<div class="settings-container">
    <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 class="header-title">Products</h2>
            <p class="header-subtitle">Manage all your products.</p>
        </div>
        <div>
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary" style="text-decoration: none;">Add New Product</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="settings-card">
        <h3 style="margin-bottom: 20px; font-size: 18px;">All Products</h3>
        
        @if($products->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <th style="padding: 12px; font-weight: 600; color: #374151;">ID</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Image</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Name</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Category</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Price</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Stock</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Status</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 12px;">{{ $product->id }}</td>
                                <td style="padding: 12px;">
                                    @if($product->image_path)
                                        <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span style="color: #9ca3af; font-size: 12px;">No Image</span>
                                    @endif
                                </td>
                                <td style="padding: 12px; font-weight: 500;">
                                    {{ $product->name }}
                                    @if($product->is_on_sale)
                                        <span style="background-color: #fde8e8; color: #9b1c1c; padding: 2px 6px; border-radius: 4px; font-size: 10px; font-weight: 600; margin-left: 5px;">SALE</span>
                                    @endif
                                </td>
                                <td style="padding: 12px;">{{ $product->category ? $product->category->name : 'N/A' }}</td>
                                <td style="padding: 12px;">
                                    @if($product->is_on_sale && $product->sale_price)
                                        <span style="text-decoration: line-through; color: #9ca3af; font-size: 12px;">Rs.{{ number_format($product->price, 2) }}</span><br>
                                        <span style="font-weight: 600; color: #111827;">Rs.{{ number_format($product->sale_price, 2) }}</span>
                                    @else
                                        Rs.{{ number_format($product->price, 2) }}
                                    @endif
                                </td>
                                <td style="padding: 12px;">{{ $product->quantity }}</td>
                                <td style="padding: 12px;">
                                    @if($product->status == 'active')
                                        <span style="background-color: #def7ec; color: #03543f; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Active</span>
                                    @else
                                        <span style="background-color: #fde8e8; color: #9b1c1c; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Inactive</span>
                                    @endif
                                </td>
                                <td style="padding: 12px;">
                                    <div style="display: flex; gap: 8px;">
                                        <a href="{{ route('admin.product.edit', $product->id) }}" class="action-btn edit-btn" title="Edit Product">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Delete Product">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p style="color: #6b7280; font-size: 14px;">No products found. Click "Add New Product" to create one.</p>
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
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        background: transparent;
    }
    .edit-btn {
        color: #2563eb;
        background-color: #eff6ff;
    }
    .edit-btn:hover {
        background-color: #dbeafe;
        color: #1d4ed8;
    }
    .delete-btn {
        color: #dc2626;
        background-color: #fef2f2;
    }
    .delete-btn:hover {
        background-color: #fee2e2;
        color: #b91c1c;
    }
</style>
@endsection
