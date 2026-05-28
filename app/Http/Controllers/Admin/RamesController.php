<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\RamesSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class RamesController extends Controller
{
    public function edit()
    {
        $setting = RamesSetting::query()->firstOrCreate(
            [],
            [
                'title_nl' => 'Onze Rames',
                'title_en' => 'Our Rames',
                'subtitle_nl' => 'Zoals Jij Het Wilt',
                'subtitle_en' => 'Just the Way You Like It',
                'small_title_nl' => 'KLEIN',
                'small_title_en' => 'KLEIN',
                'large_title_nl' => 'GROOT',
                'large_title_en' => 'GROOT',
                'small_desc' => '1x vlees of vis, 1x groente & sambal goreng ei',
                'large_desc' => '2x vlees of vis, 2x groente, Tahoe of Tempe & sambal goreng ei',
                'instruction_nl' => 'Kies eerst jouw grootte en kies daarna in 3 simpele stappen de rest van jouw rames.',
                'instruction_en' => 'Choose your size first, then complete your rames in 3 simple steps.',
            ]
        );

        $categories = Category::query()
            ->with(['products' => fn ($q) => $q->active()->ordered()])
            ->ordered()
            ->get();

        $selectedByGroup = [
            'basis' => Product::query()->rames()->ramesGroup('basis')->pluck('id')->all(),
            'kip' => Product::query()->rames()->ramesGroup('kip')->pluck('id')->all(),
            'vlees' => Product::query()->rames()->ramesGroup('vlees')->pluck('id')->all(),
            'vis' => Product::query()->rames()->ramesGroup('vis')->pluck('id')->all(),
            'groenten' => Product::query()->rames()->ramesGroup('groenten')->pluck('id')->all(),
        ];

        $groupedOptions = [
            'basis' => Product::query()->with('category')->active()->whereHas('category', fn ($q) => $q->whereIn('slug', ['rames-klein', 'rames-normaal']))->ordered()->get(),
            'kip' => Product::query()->with('category')->active()->whereHas('category', fn ($q) => $q->where('slug', 'kip'))->ordered()->get(),
            'vlees' => Product::query()->with('category')->active()->whereHas('category', fn ($q) => $q->where('slug', 'vlees'))->ordered()->get(),
            'vis' => Product::query()->with('category')->active()->whereHas('category', fn ($q) => $q->where('slug', 'vis'))->ordered()->get(),
            'groenten' => Product::query()->with('category')->active()->whereHas('category', fn ($q) => $q->where('slug', 'groente'))->ordered()->get(),
        ];

        return view('admin.rames.edit', compact('setting', 'categories', 'groupedOptions', 'selectedByGroup'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title_nl' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'subtitle_nl' => 'required|string|max:255',
            'subtitle_en' => 'required|string|max:255',
            'small_title_nl' => 'required|string|max:255',
            'small_title_en' => 'required|string|max:255',
            'large_title_nl' => 'required|string|max:255',
            'large_title_en' => 'required|string|max:255',
            'small_price' => 'required|numeric|min:0',
            'large_surcharge' => 'required|numeric|min:0',
            'small_desc' => 'nullable|string|max:255',
            'large_desc' => 'nullable|string|max:255',
            'instruction_nl' => 'nullable|string|max:255',
            'instruction_en' => 'nullable|string|max:255',
            'button_label_nl' => 'nullable|string|max:255',
            'button_label_en' => 'nullable|string|max:255',
            'bottom_title_nl' => 'nullable|string|max:255',
            'bottom_title_en' => 'nullable|string|max:255',
            'bottom_text_nl' => 'nullable|string|max:2000',
            'bottom_text_en' => 'nullable|string|max:2000',
            'rames_basis_ids' => 'nullable|array',
            'rames_basis_ids.*' => 'exists:products,id',
            'rames_kip_ids' => 'nullable|array',
            'rames_kip_ids.*' => 'exists:products,id',
            'rames_vlees_ids' => 'nullable|array',
            'rames_vlees_ids.*' => 'exists:products,id',
            'rames_vis_ids' => 'nullable|array',
            'rames_vis_ids.*' => 'exists:products,id',
            'rames_groenten_ids' => 'nullable|array',
            'rames_groenten_ids.*' => 'exists:products,id',
        ]);

        DB::transaction(function () use ($validated) {
            $setting = RamesSetting::query()->firstOrCreate([]);
            $setting->update($validated);

            Product::query()->update([
                'is_rames' => false,
                'rames_group' => null,
            ]);

            $groups = [
                'basis' => $validated['rames_basis_ids'] ?? [],
                'kip' => $validated['rames_kip_ids'] ?? [],
                'vlees' => $validated['rames_vlees_ids'] ?? [],
                'vis' => $validated['rames_vis_ids'] ?? [],
                'groenten' => $validated['rames_groenten_ids'] ?? [],
            ];

            foreach ($groups as $group => $ids) {
                foreach ($ids as $productId) {
                    Product::query()->whereKey($productId)->update([
                        'is_rames' => true,
                        'rames_group' => $group,
                    ]);
                }
            }
        });

        Cache::forget('client.menu.categories.nl');
        Cache::forget('client.menu.categories.en');

        return redirect()->route('admin.rames.edit')->with('success', 'Rames settings berhasil diperbarui.');
    }
}
