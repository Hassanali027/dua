<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('id', 'desc')->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts',
            'author_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'status' => 'boolean',
            'is_popular' => 'boolean',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255'
        ]);

        $post = new BlogPost();
        $post->name = $request->name;
        $post->slug = Str::slug($request->slug);
        $post->author_name = $request->author_name;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->long_description = $request->long_description;
        $post->status = $request->has('status') ? 1 : 0;
        $post->is_popular = $request->has('is_popular') ? 1 : 0;
        $post->facebook_link = $request->facebook_link;
        $post->twitter_link = $request->twitter_link;
        $post->instagram_link = $request->instagram_link;
        $post->youtube_link = $request->youtube_link;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/blog'), $filename);
            $post->image_path = 'images/blog/' . $filename;
        }

        if ($request->hasFile('author_image')) {
            $author_image = $request->file('author_image');
            $author_filename = time() . '_author_' . $author_image->getClientOriginalName();
            $author_image->move(public_path('images/blog'), $author_filename);
            $post->author_image = 'images/blog/' . $author_filename;
        }

        $post->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully.');
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $post->id,
            'author_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'status' => 'boolean',
            'is_popular' => 'boolean',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255'
        ]);

        $post->name = $request->name;
        $post->slug = Str::slug($request->slug);
        $post->author_name = $request->author_name;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->long_description = $request->long_description;
        $post->status = $request->has('status') ? 1 : 0;
        $post->is_popular = $request->has('is_popular') ? 1 : 0;
        $post->facebook_link = $request->facebook_link;
        $post->twitter_link = $request->twitter_link;
        $post->instagram_link = $request->instagram_link;
        $post->youtube_link = $request->youtube_link;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image_path && File::exists(public_path($post->image_path))) {
                File::delete(public_path($post->image_path));
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/blog'), $filename);
            $post->image_path = 'images/blog/' . $filename;
        }

        if ($request->hasFile('author_image')) {
            // Delete old image
            if ($post->author_image && File::exists(public_path($post->author_image))) {
                File::delete(public_path($post->author_image));
            }

            $author_image = $request->file('author_image');
            $author_filename = time() . '_author_' . $author_image->getClientOriginalName();
            $author_image->move(public_path('images/blog'), $author_filename);
            $post->author_image = 'images/blog/' . $author_filename;
        }

        $post->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        if ($post->image_path && File::exists(public_path($post->image_path))) {
            File::delete(public_path($post->image_path));
        }

        if ($post->author_image && File::exists(public_path($post->author_image))) {
            File::delete(public_path($post->author_image));
        }

        $post->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully.');
    }
}
