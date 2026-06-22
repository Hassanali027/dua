@extends('admin.layouts.app')

@section('content')
<div class="settings-container" style="max-width: 1200px; margin: 0 auto;">
    <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 class="header-title" style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin-bottom: 5px;">Customer Reviews</h2>
            <p class="header-subtitle" style="color: #6b7280; font-size: 14px;">Manage and approve customer reviews for your products.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #def7ec; color: #03543f; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #84e1bc;">
            {{ session('success') }}
        </div>
    @endif

    <div class="settings-card" style="background: #fff; border-radius: 8px; padding: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 20px; font-size: 18px;">All Reviews</h3>
        
        @if($reviews->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Date</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Product</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Customer</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Rating</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Review</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Status</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 12px; font-size: 14px;">{{ $review->created_at->format('M d, Y') }}</td>
                                <td style="padding: 12px; font-size: 14px; font-weight: 500;">
                                    <a href="{{ route('product', $review->product_id) }}" target="_blank" style="color: #2563eb; text-decoration: none;">
                                        {{ $review->product->name }}
                                    </a>
                                </td>
                                <td style="padding: 12px; font-size: 14px;">
                                    {{ $review->name }}<br>
                                    <span style="color: #6b7280; font-size: 12px;">{{ $review->email }}</span>
                                </td>
                                <td style="padding: 12px; font-size: 14px; color: #fbbf24;">
                                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                </td>
                                <td style="padding: 12px; font-size: 14px; max-width: 300px;">
                                    {{ Str::limit($review->review_text, 80) }}
                                </td>
                                <td style="padding: 12px;">
                                    @if($review->status == 'approved')
                                        <span style="background-color: #def7ec; color: #03543f; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Approved</span>
                                    @else
                                        <span style="background-color: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Pending</span>
                                    @endif
                                </td>
                                <td style="padding: 12px;">
                                    <div style="display: flex; gap: 8px;">
                                        @if($review->status != 'approved')
                                        <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="action-btn" style="background-color: #def7ec; color: #03543f; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: 600;" title="Approve Review">
                                                Approve
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn" style="background-color: #fde8e8; color: #9b1c1c; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: 600;" title="Delete Review">
                                                Delete
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
            <p style="color: #6b7280; font-size: 14px;">No reviews found.</p>
        @endif
    </div>
</div>
@endsection
