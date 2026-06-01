<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\RamesItem;
use App\Models\RamesSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RamesController extends Controller
{
    /** Key form admin → kolom database. */
    private const SECTIONS = [
        'basis' => [
            'label' => 'DE BASIS — nasi, mie, dll.',
            'section' => 'basis',
            'subsection' => null,
        ],
        'kip' => [
            'label' => 'KIP — produk ayam',
            'section' => 'vlees_of_vis',
            'subsection' => 'kip',
        ],
        'vlees' => [
            'label' => 'VLEES — produk daging',
            'section' => 'vlees_of_vis',
            'subsection' => 'vlees',
        ],
        'vis' => [
            'label' => 'VIS — produk ikan',
            'section' => 'vlees_of_vis',
            'subsection' => 'vis',
        ],
        'groenten' => [
            'label' => 'DE GROENTEN — sayur, sambal goreng, dll.',
            'section' => 'groenten',
            'subsection' => null,
        ],
    ];

    public function edit(): View
    {
        $setting = RamesSetting::query()->firstOrCreate([], [
            'title_nl' => 'Onze Rames',
            'title_en' => 'Our Rames',
            'subtitle_nl' => 'Zoals Jij Het Wilt',
            'subtitle_en' => 'Just the Way You Like It',
            'small_title_nl' => 'KLEIN',
            'small_title_en' => 'KLEIN',
            'large_title_nl' => 'GROOT',
            'large_title_en' => 'GROOT',
            'small_price' => 13.75,
            'large_surcharge' => 3.00,
            'small_desc' => '1x vlees of vis, 1x groente & sambal goreng ei',
            'large_desc' => '2x vlees of vis, 2x groente, Tahoe of Tempe & sambal goreng ei',
            'instruction_nl' => 'Kies eerst jouw grootte en kies daarna in 3 simpele stappen de rest van jouw rames.',
            'instruction_en' => 'Choose your size first, then complete your rames in 3 simple steps.',
            'button_label_nl' => 'Bekijk Volledige Menu',
            'button_label_en' => 'View Full Menu',
        ]);

        $assignedIds = RamesItem::query()->pluck('product_id');

        $availableProducts = Product::query()
            ->active()
            ->ordered()
            ->when($assignedIds->isNotEmpty(), fn ($q) => $q->whereNotIn('id', $assignedIds))
            ->get(['id', 'name', 'description_nl', 'description_en', 'description']);

        $sections = [];
        foreach (self::SECTIONS as $key => $config) {
            $itemsQuery = RamesItem::query()
                ->with(['product' => fn ($q) => $q->active()->ordered()])
                ->where('section', $config['section']);

            if ($config['subsection']) {
                $itemsQuery->where('subsection', $config['subsection']);
            } else {
                $itemsQuery->whereNull('subsection');
            }

            $sections[$key] = [
                'label' => $config['label'],
                'items' => $itemsQuery->get(),
            ];
        }

        return view('admin.rames.edit', compact('setting', 'sections', 'availableProducts'));
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title_nl' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'subtitle_nl' => 'nullable|string|max:255',
            'subtitle_en' => 'nullable|string|max:255',
            'small_title_nl' => 'nullable|string|max:50',
            'small_title_en' => 'nullable|string|max:50',
            'large_title_nl' => 'nullable|string|max:50',
            'large_title_en' => 'nullable|string|max:50',
            'small_price' => 'nullable|numeric|min:0',
            'large_surcharge' => 'nullable|numeric|min:0',
            'small_desc' => 'nullable|string|max:500',
            'large_desc' => 'nullable|string|max:500',
            'instruction_nl' => 'nullable|string|max:500',
            'instruction_en' => 'nullable|string|max:500',
            'button_label_nl' => 'nullable|string|max:100',
            'button_label_en' => 'nullable|string|max:100',
            'bottom_title_nl' => 'nullable|string|max:255',
            'bottom_title_en' => 'nullable|string|max:255',
            'bottom_text_nl' => 'nullable|string|max:1000',
            'bottom_text_en' => 'nullable|string|max:1000',
        ]);

        $setting = RamesSetting::query()->firstOrCreate([]);
        $setting->update($data);

        return redirect()
            ->route('admin.rames.edit')
            ->with('success', 'Teks bagian Rames berhasil disimpan.');
    }

    public function storeItem(Request $request): RedirectResponse
    {
        $request->validate([
            'section_key' => 'required|in:' . implode(',', array_keys(self::SECTIONS)),
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $config = self::SECTIONS[$request->input('section_key')];
        $productId = (int) $request->input('product_id');

        $product = Product::query()->active()->find($productId);
        if (! $product) {
            return back()->withErrors(['product_id' => 'Produk tidak aktif atau tidak ditemukan.']);
        }

        if (RamesItem::query()->where('product_id', $productId)->exists()) {
            return back()->withErrors([
                'product_id' => "{$product->name} sudah ada di menu Rames. Hapus dulu dari bagian lain jika ingin memindahkan.",
            ]);
        }

        RamesItem::query()->create([
            'product_id' => $productId,
            'section' => $config['section'],
            'subsection' => $config['subsection'],
        ]);

        return redirect()
            ->route('admin.rames.edit')
            ->with('success', "{$product->name} ditambahkan ke {$this->sectionLabel($request->input('section_key'))}.");
    }

    public function destroyItem(RamesItem $ramesItem): RedirectResponse
    {
        $name = $ramesItem->product?->name ?? 'Produk';
        $ramesItem->delete();

        return redirect()
            ->route('admin.rames.edit')
            ->with('success', "{$name} dihapus dari menu Rames.");
    }

    private function sectionLabel(string $key): string
    {
        return match ($key) {
            'basis' => 'DE BASIS',
            'kip' => 'KIP',
            'vlees' => 'VLEES',
            'vis' => 'VIS',
            'groenten' => 'DE GROENTEN',
            default => 'menu Rames',
        };
    }
}
