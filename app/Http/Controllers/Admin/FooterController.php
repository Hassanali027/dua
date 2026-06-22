<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;

class FooterController extends Controller
{
    public function index()
    {
        return view('admin.footer.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'footer_text' => 'nullable|string',
            'footer_twitter' => 'nullable|string',
            'footer_facebook' => 'nullable|string',
            'footer_instagram' => 'nullable|string',
            'footer_github' => 'nullable|string',
            'footer_address' => 'nullable|string',
            'footer_email' => 'nullable|string',
            'footer_phone' => 'nullable|string',
            'footer_timing' => 'nullable|string',
        ]);

        $settings = $request->only([
            'footer_text', 'footer_twitter', 'footer_facebook', 'footer_instagram', 'footer_github',
            'footer_address', 'footer_email', 'footer_phone', 'footer_timing'
        ]);

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Footer settings updated successfully!');
    }
}
