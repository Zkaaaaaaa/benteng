<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Menampilkan halaman kelola galeri foto (data di localStorage via JS).
     */
    public function edit(): View
    {
        return view('admin.gallery.edit');
    }
}
