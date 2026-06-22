@extends('admin.layouts.app')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Orders</h2>
</div>

<div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 20px;">
    @if(session('success'))
        <div style="background: #dcfce3; color: #166534; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid #eee; text-align: left;">
                <th style="padding: 12px; color: #666; font-weight: 600;">Order No</th>
                <th style="padding: 12px; color: #666; font-weight: 600;">Date</th>
                <th style="padding: 12px; color: #666; font-weight: 600;">Customer</th>
                <th style="padding: 12px; color: #666; font-weight: 600;">Total</th>
                <th style="padding: 12px; color: #666; font-weight: 600;">Status</th>
                <th style="padding: 12px; color: #666; font-weight: 600;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;"><strong>{{ $order->order_number }}</strong></td>
                    <td style="padding: 12px; color: #666;">{{ $order->created_at->format('d M, Y') }}</td>
                    <td style="padding: 12px;">
                        {{ $order->first_name }} {{ $order->last_name }}<br>
                        <small style="color: #888;">{{ $order->email }}</small>
                    </td>
                    <td style="padding: 12px;">Rs {{ number_format($order->total_amount) }}</td>
                    <td style="padding: 12px;">
                        <span style="background: {{ $order->status == 'Completed' ? '#dcfce3' : ($order->status == 'Pending' ? '#fef08a' : '#e0e7ff') }}; color: #333; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td style="padding: 12px; display: flex; gap: 8px;">
                        <a href="{{ route('admin.orders.show', $order->id) }}" style="color: #000; text-decoration: none; font-weight: 500; font-size: 14px; border: 1px solid #ddd; padding: 4px 10px; border-radius: 4px; transition: all 0.2s;">View</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: #dc2626; background: none; border: 1px solid #fca5a5; font-weight: 500; font-size: 14px; padding: 4px 10px; border-radius: 4px; cursor: pointer; transition: all 0.2s;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #888;">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection
