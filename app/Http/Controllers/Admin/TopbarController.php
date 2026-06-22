<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class TopbarController extends Controller
{
    public function index()
    {
        return view('admin.topbar.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'topbar_text' => 'nullable|string',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
        ]);

        $settings = $request->only(['topbar_text', 'facebook_link', 'instagram_link']);

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Topbar settings updated successfully.');
    }
}
