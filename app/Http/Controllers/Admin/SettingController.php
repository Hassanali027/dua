<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $site_title = Setting::get('site_title', 'Dua Mehrama');
        $site_description = Setting::get('site_description', '');

        return view('admin.settings', compact('site_title', 'site_description'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_description' => 'nullable|string',
        ]);

        Setting::updateOrCreate(
            ['key' => 'site_title'],
            ['value' => $request->site_title]
        );

        Setting::updateOrCreate(
            ['key' => 'site_description'],
            ['value' => $request->site_description]
        );

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }
}
