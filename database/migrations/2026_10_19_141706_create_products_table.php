<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('original_price')->nullable();
            $table->unsignedInteger('discount_percentage')->default(0);
            $table->string('category')->index();
            $table->string('brand')->nullable();
            $table->text('image');
            $table->json('gallery')->nullable();
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->unsignedInteger('review_count')->default(0);
            $table->unsignedInteger('sold_count')->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->unsignedInteger('min_order')->default(1);
            $table->string('condition')->default('Baru');
            $table->string('availability')->default('Siap Dikirim');
            $table->string('supplier')->default('Toko Terverifikasi');
            $table->json('specifications')->nullable();
            $table->json('tags')->nullable();
            $table->string('address')->nullable();
            $table->text('map_url')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
