<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StaticPage;

class StaticPageController extends Controller
{
    public function index()
    {
        $pages = StaticPage::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = StaticPage::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'content' => 'required|string',
        ]);

        $page = StaticPage::findOrFail($id);
        $page->update([
            'title' => $request->title,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'content' => $request->content,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }
}
