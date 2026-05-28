<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rames_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title_nl')->default('Onze Rames');
            $table->string('title_en')->default('Our Rames');
            $table->string('subtitle_nl')->default('Zoals Jij Het Wilt');
            $table->string('subtitle_en')->default('Just the Way You Like It');
            $table->decimal('small_price', 10, 2)->default(13.75);
            $table->decimal('large_surcharge', 10, 2)->default(3.00);
            $table->string('small_desc')->nullable();
            $table->string('large_desc')->nullable();
            $table->string('instruction_nl')->nullable();
            $table->string('instruction_en')->nullable();
            $table->string('button_label_nl')->default('Bekijk Volledige Menu');
            $table->string('button_label_en')->default('View Full Menu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rames_settings');
    }
};
