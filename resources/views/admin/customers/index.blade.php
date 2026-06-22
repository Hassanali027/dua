@extends('admin.layouts.app')

@section('content')
<div class="settings-container">
    <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 class="header-title">Customers</h2>
            <p class="header-subtitle">Manage registered customers.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="settings-card">
        <h3 style="margin-bottom: 20px; font-size: 18px;">All Customers</h3>
        
        @if($customers->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <th style="padding: 12px; font-weight: 600; color: #374151;">ID</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Name</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Email</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Registered On</th>
                            <th style="padding: 12px; font-weight: 600; color: #374151;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 12px;">{{ $customer->id }}</td>
                                <td style="padding: 12px; font-weight: 500;">{{ $customer->name }}</td>
                                <td style="padding: 12px;">{{ $customer->email }}</td>
                                <td style="padding: 12px;">{{ $customer->created_at->format('M d, Y') }}</td>
                                <td style="padding: 12px;">
                                    <div style="display: flex; gap: 8px;">
                                        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="action-btn edit-btn" title="Edit Customer">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Delete Customer">
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
            <p style="color: #6b7280; font-size: 14px;">No customers found.</p>
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
