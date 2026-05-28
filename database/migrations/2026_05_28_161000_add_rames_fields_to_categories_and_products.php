<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('rames_section', 20)->nullable()->after('show_on_home');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_rames')->default(false)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('rames_section');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_rames');
        });
    }
};
