<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function index()
    {
        $topLinksJson = Setting::get('navbar_top_links', '[]');
        $topLinks = json_decode($topLinksJson, true) ?? [];

        if (empty($topLinks) && Setting::where('key', 'navbar_top_links')->count() == 0) {
            $topLinks = [
                ['label' => 'Women', 'url' => '#'],
                ['label' => 'Kids', 'url' => '#'],
                ['label' => 'Brides', 'url' => '#'],
                ['label' => 'Summer Sale', 'url' => '#'],
                ['label' => 'Clearance', 'url' => '#']
            ];
        }

        return view('admin.navbar', compact('topLinks'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'top_links' => 'nullable|array',
            'top_links.*.label' => 'required|string|max:255',
            'top_links.*.url' => 'required|string|max:255',
        ]);

        $topLinks = $request->top_links ?? [];

        Setting::updateOrCreate(
            ['key' => 'navbar_top_links'],
            ['value' => json_encode($topLinks)]
        );

        return back()->with('success', 'Navbar settings updated successfully.');
    }
}
