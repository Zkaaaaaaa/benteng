<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title1');
            $table->text('desc1');
            $table->string('img1');
            $table->string('title2')->nullable();
            $table->text('desc2')->nullable();
            $table->string('img2')->nullable();
            $table->string('store_name1');
            $table->string('store_name2')->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->decimal('lat_coordinate1', 10, 7)->nullable();
            $table->decimal('lon_coordinate1', 10, 7)->nullable();
            $table->decimal('lat_coordinate2', 10, 7)->nullable();
            $table->decimal('lon_coordinate2', 10, 7)->nullable();
            $table->string('img_store1')->nullable();
            $table->string('img_store2')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('store_link1')->nullable();
            $table->string('store_link2')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('title');
            $table->string('opening_hour')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
