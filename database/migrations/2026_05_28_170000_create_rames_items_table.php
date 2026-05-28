<?php

use App\Models\Product;
use App\Models\RamesItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rames_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('section', 32); // basis | vlees_of_vis | groenten
            $table->string('subsection', 32)->nullable(); // kip | vlees | vis
            $table->timestamps();

            $table->unique('product_id');
            $table->index(['section', 'subsection']);
        });

        $this->migrateFromLegacyProductFlags();
    }

    public function down(): void
    {
        Schema::dropIfExists('rames_items');
    }

    /** Pindahkan data lama dari products.rames_group ke rames_items (sekali jalan). */
    private function migrateFromLegacyProductFlags(): void
    {
        if (! Schema::hasColumn('products', 'rames_group')) {
            return;
        }

        Product::query()
            ->where('is_rames', true)
            ->whereNotNull('rames_group')
            ->each(function (Product $product) {
                $group = $product->rames_group;
                if (! in_array($group, ['basis', 'kip', 'vlees', 'vis', 'groenten'], true)) {
                    return;
                }

                $section = in_array($group, ['kip', 'vlees', 'vis'], true) ? 'vlees_of_vis' : $group;
                $subsection = in_array($group, ['kip', 'vlees', 'vis'], true) ? $group : null;

                RamesItem::query()->updateOrCreate(
                    ['product_id' => $product->id],
                    ['section' => $section, 'subsection' => $subsection]
                );
            });
    }
};
