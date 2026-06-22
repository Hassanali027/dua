@extends('admin.layouts.app')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Static Pages</h2>
</div>

@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 10px 15px; border-radius: 4px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

<div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid #eee; text-align: left;">
                <th style="padding: 12px; font-weight: 600; color: #555;">ID</th>
                <th style="padding: 12px; font-weight: 600; color: #555;">Name</th>
                <th style="padding: 12px; font-weight: 600; color: #555;">Slug</th>
                <th style="padding: 12px; font-weight: 600; color: #555;">Status</th>
                <th style="padding: 12px; font-weight: 600; color: #555;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px;">{{ $page->id }}</td>
                <td style="padding: 12px; font-weight: 500;">{{ $page->name }}</td>
                <td style="padding: 12px; color: #666;">/{{ $page->slug }}</td>
                <td style="padding: 12px;">
                    @if($page->status)
                        <span style="background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Active</span>
                    @else
                        <span style="background: #f8d7da; color: #721c24; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Inactive</span>
                    @endif
                </td>
                <td style="padding: 12px;">
                    <a href="{{ route('admin.pages.edit', $page->id) }}" style="background: #000; color: #fff; text-decoration: none; padding: 6px 12px; border-radius: 4px; font-size: 13px; font-weight: 500;">Edit Page</a>
                </td>
            </tr>
            @endforeach
            @if($pages->isEmpty())
            <tr>
                <td colspan="5" style="padding: 20px; text-align: center; color: #888;">No static pages found. Run migrations and seeders.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
