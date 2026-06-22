@extends('admin.layouts.app')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div>
        <a href="{{ route('admin.orders.index') }}" style="text-decoration: none; color: #666; font-size: 14px;">&larr; Back to Orders</a>
        <h2 style="margin-top: 5px;">Order #{{ $order->order_number }}</h2>
    </div>
    
    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" style="display: flex; gap: 10px; align-items: center;">
        @csrf
        <label style="font-size: 14px; color: #555; font-weight: 500;">Status:</label>
        <select name="status" style="padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
            <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <button type="submit" style="background: #000; color: #fff; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Update</button>
    </form>
</div>

@if(session('success'))
    <div style="background: #dcfce3; color: #166534; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
    <!-- Items & General Info -->
    <div>
        <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0; font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Items Ordered</h3>
            
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="border-bottom: 2px solid #eee; text-align: left; font-size: 14px; color: #666;">
                        <th style="padding: 10px;">Product</th>
                        <th style="padding: 10px;">Size</th>
                        <th style="padding: 10px;">Price</th>
                        <th style="padding: 10px;">Qty</th>
                        <th style="padding: 10px; text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr style="border-bottom: 1px solid #eee; font-size: 14px;">
                            <td style="padding: 10px;">
                                {{ $item->product_name }}
                            </td>
                            <td style="padding: 10px;">{{ $item->size }}</td>
                            <td style="padding: 10px;">Rs {{ number_format($item->price) }}</td>
                            <td style="padding: 10px;">x{{ $item->quantity }}</td>
                            <td style="padding: 10px; text-align: right;">Rs {{ number_format($item->price * $item->quantity) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="width: 300px; margin-left: auto; margin-top: 20px; font-size: 14px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #555;">
                    <span>Subtotal</span>
                    <span>Rs {{ number_format($order->subtotal) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #555;">
                    <span>Shipping</span>
                    <span>Rs {{ number_format($order->shipping) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 10px; padding-top: 10px; border-top: 1px solid #eee; font-weight: 600; font-size: 16px;">
                    <span>Total</span>
                    <span>Rs {{ number_format($order->total_amount) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Details -->
    <div>
        <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0; font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Customer Info</h3>
            <div style="font-size: 14px; color: #444; line-height: 1.6; margin-top: 10px;">
                <strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}<br>
                <strong>Email:</strong> {{ $order->email }}<br>
                <strong>Phone:</strong> {{ $order->phone }}<br>
                <strong>Payment Method:</strong> {{ $order->payment_method }}
            </div>
        </div>

        <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0; font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Shipping Address</h3>
            <div style="font-size: 14px; color: #444; line-height: 1.6; margin-top: 10px;">
                {{ $order->address }}<br>
                {{ $order->city }}<br>
                @if($order->postal_code)
                    Postal Code: {{ $order->postal_code }}<br>
                @endif
                Pakistan
            </div>
        </div>

        <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 20px;">
            <h3 style="margin-top: 0; font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Billing Address</h3>
            <div style="font-size: 14px; color: #444; line-height: 1.6; margin-top: 10px;">
                @if($order->billing_first_name)
                    {{ $order->billing_first_name }} {{ $order->billing_last_name }}<br>
                    {{ $order->billing_address }}<br>
                    {{ $order->billing_city }}<br>
                    @if($order->billing_postal_code)
                        Postal Code: {{ $order->billing_postal_code }}<br>
                    @endif
                    @if($order->billing_phone)
                        Phone: {{ $order->billing_phone }}<br>
                    @endif
                    Pakistan
                @else
                    <span style="color: #888;">Same as shipping address</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
