@extends('admin.layouts.app')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Manage Blogs</h2>
    <a href="{{ route('admin.blog.create') }}" class="btn-add" style="background: #1a1a1a; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-weight: 500; font-size: 14px; display: inline-block;">+ Add New Blog</a>
</div>

@if(session('success'))
    <div style="background: #dcfce3; color: #166534; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

<div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f9fafb; border-bottom: 1px solid #eee;">
                <th style="padding: 15px; font-weight: 600; font-size: 14px; color: #374151;">ID</th>
                <th style="padding: 15px; font-weight: 600; font-size: 14px; color: #374151;">Image</th>
                <th style="padding: 15px; font-weight: 600; font-size: 14px; color: #374151;">Name</th>
                <th style="padding: 15px; font-weight: 600; font-size: 14px; color: #374151;">Author</th>
                <th style="padding: 15px; font-weight: 600; font-size: 14px; color: #374151;">Status</th>
                <th style="padding: 15px; font-weight: 600; font-size: 14px; color: #374151; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 15px; font-size: 14px; color: #6b7280;">#{{ $post->id }}</td>
                <td style="padding: 15px;">
                    @if($post->image_path)
                        <img src="{{ asset($post->image_path) }}" alt="Blog Image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                    @else
                        <div style="width: 60px; height: 60px; background: #eee; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999; font-size: 12px;">No Img</div>
                    @endif
                </td>
                <td style="padding: 15px; font-size: 14px; color: #111; font-weight: 500;">
                    {{ $post->name }}
                    <br>
                    <small style="color: #6b7280; font-weight: 400;">/blog/{{ $post->slug }}</small>
                </td>
                <td style="padding: 15px; font-size: 14px; color: #111;">{{ $post->author_name ?? '-' }}</td>
                <td style="padding: 15px;">
                    @if($post->status)
                        <span style="background: #dcfce3; color: #166534; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">Active</span>
                    @else
                        <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">Inactive</span>
                    @endif
                </td>
                <td style="padding: 15px; text-align: right;">
                    <a href="{{ route('admin.blog.edit', $post->id) }}" style="color: #4f46e5; text-decoration: none; font-size: 14px; font-weight: 500; margin-right: 15px;">Edit</a>
                    <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #dc2626; cursor: pointer; font-size: 14px; font-weight: 500;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 30px; text-align: center; color: #6b7280; font-size: 14px;">No blog posts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
