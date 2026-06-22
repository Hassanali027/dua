<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.color.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.color.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:colors,name',
        ]);

        Color::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.color.index')->with('success', 'Color created successfully.');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('admin.color.index')->with('success', 'Color deleted successfully.');
    }
}
