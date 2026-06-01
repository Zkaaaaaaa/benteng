<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use App\Support\PublicStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function edit(): View
    {
        $photos = GalleryPhoto::query()->latest()->get();

        return view('admin.gallery.edit', compact('photos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        GalleryPhoto::query()->create([
            'name' => $validated['name'],
            'path' => PublicStorage::store($request->file('image'), 'gallery'),
        ]);

        return redirect()
            ->route('admin.gallery.edit')
            ->with('success', 'Foto berhasil diunggah ke galeri.');
    }

    public function destroy(GalleryPhoto $galleryPhoto): RedirectResponse
    {
        $galleryPhoto->delete();

        return redirect()
            ->route('admin.gallery.edit')
            ->with('success', 'Foto berhasil dihapus dari galeri.');
    }
}
