<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->nullable()->after('slug');
            $table->text('subtitle')->nullable()->after('image');
            $table->unsignedSmallInteger('sort_order')->default(0)->after('subtitle');
            $table->boolean('show_on_home')->default(false)->after('sort_order');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('unit_label')->nullable()->after('price');
            $table->boolean('is_spicy')->default(false)->after('unit_label');
            $table->unsignedSmallInteger('sort_order')->default(0)->after('is_spicy');
            $table->boolean('is_active')->default(true)->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['image', 'subtitle', 'sort_order', 'show_on_home']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['unit_label', 'is_spicy', 'sort_order', 'is_active']);
        });
    }
};
