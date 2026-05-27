<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $siteSetting = SiteSetting::firstOrFail();

        return view('admin.site-setting.edit', compact('siteSetting'));
    }

    public function update(Request $request)
    {
        $siteSetting = SiteSetting::firstOrFail();

        $validated = $request->validate([
            'title1' => 'required|string|max:255',
            'desc1' => 'required|string',
            'title2' => 'nullable|string|max:255',
            'desc2' => 'nullable|string',
            'store_name1' => 'required|string|max:255',
            'store_name2' => 'nullable|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'lat_coordinate1' => 'nullable|numeric',
            'lon_coordinate1' => 'nullable|numeric',
            'lat_coordinate2' => 'nullable|numeric',
            'lon_coordinate2' => 'nullable|numeric',
            'store_link1' => 'nullable|url',
            'store_link2' => 'nullable|url',
            'phone1' => 'nullable|string|max:50',
            'phone2' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'opening_hour' => 'nullable|string|max:255',

            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'img1' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'img2' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'img_store1' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'img_store2' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $imageFields = ['logo', 'img1', 'img2', 'img_store1', 'img_store2'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($siteSetting->$field && str_starts_with($siteSetting->$field, 'storage/')) {
                    $oldPath = str_replace('storage/', '', $siteSetting->$field);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $path = $request->file($field)->store('settings', 'public');
                $validated[$field] = 'storage/'.$path;
            } else {
                $validated[$field] = $siteSetting->$field;
            }
        }

        $siteSetting->update($validated);

        return redirect()
            ->route('admin.site-settings.edit')
            ->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
