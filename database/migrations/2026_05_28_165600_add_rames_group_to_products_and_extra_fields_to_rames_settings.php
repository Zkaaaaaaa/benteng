<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('rames_group', 20)->nullable()->after('is_rames');
        });

        Schema::table('rames_settings', function (Blueprint $table) {
            $table->string('small_title_nl')->default('KLEIN')->after('subtitle_en');
            $table->string('small_title_en')->default('KLEIN')->after('small_title_nl');
            $table->string('large_title_nl')->default('GROOT')->after('small_title_en');
            $table->string('large_title_en')->default('GROOT')->after('large_title_nl');
            $table->string('bottom_title_nl')->nullable()->after('button_label_en');
            $table->string('bottom_title_en')->nullable()->after('bottom_title_nl');
            $table->text('bottom_text_nl')->nullable()->after('bottom_title_en');
            $table->text('bottom_text_en')->nullable()->after('bottom_text_nl');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('rames_group');
        });

        Schema::table('rames_settings', function (Blueprint $table) {
            $table->dropColumn([
                'small_title_nl',
                'small_title_en',
                'large_title_nl',
                'large_title_en',
                'bottom_title_nl',
                'bottom_title_en',
                'bottom_text_nl',
                'bottom_text_en',
            ]);
        });
    }
};
