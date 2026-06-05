<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori menu.
     */
    public function index()
    {
        $categories = Category::query()
            ->withCount('products')
            ->ordered()
            ->get();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name'       => $request->name,
            'slug'       => Str::slug($request->name),
            'sort_order' => (int) Category::query()->max('sort_order') + 1,
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Memperbarui urutan kategori (drag & drop).
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:categories,id',
        ]);

        foreach ($validated['order'] as $position => $id) {
            Category::query()
                ->whereKey($id)
                ->update(['sort_order' => $position + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Memperbarui data kategori yang sudah ada.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
