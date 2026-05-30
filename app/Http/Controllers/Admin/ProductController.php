<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.product.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => ['required', 'string', 'max:255',
                                 Rule::unique('products')->where('category_id', $request->category_id)],
            'price'          => 'required|numeric|min:0',
            'description_en' => 'nullable|string',
            'description_nl' => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $category = Category::findOrFail($request->category_id);

        Product::create([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'slug'           => Str::slug($request->name) . '-' . $category->slug,
            'price'          => $request->price,
            'description_en' => $request->description_en,
            'description_nl' => $request->description_nl,
            'description'    => $request->description_en ?: $request->description_nl,
            'image'          => $imagePath,
        ]);

        return back()->with('success', 'Produk baru berhasil ditambahkan!');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => ['required', 'string', 'max:255',
                                 Rule::unique('products')->where('category_id', $request->category_id)->ignore($product->id)],
            'price'          => 'required|numeric|min:0',
            'description_en' => 'nullable|string',
            'description_nl' => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'slug'           => Str::slug($request->name) . '-' . $product->category->slug,
            'price'          => $request->price,
            'description_en' => $request->description_en,
            'description_nl' => $request->description_nl,
            'description'    => $request->description_en ?: $request->description_nl,
            'image'          => $imagePath,
        ]);

        return back()->with('success', 'Data produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus!');
    }
}