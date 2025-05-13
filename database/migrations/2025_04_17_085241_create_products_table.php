<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis
            $table->string('name', 255); // Nama produk
            $table->string('slug', 255)->unique(); // Slug produk
            $table->text('description')->nullable(); // Deskripsi produk
            $table->string('sku', 50)->unique(); // SKU produk
            $table->decimal('price', 10, 2)->default(0); // Harga produk
            $table->integer('stock')->default(0); // Stok produk
            $table->foreignId('product_category_id')
                ->nullable()
                ->constrained('product_categories')
                ->onUpdate('cascade')
                ->onDelete('set null'); // Relasi ke tabel product_categories
            $table->string('image_url', 255)->nullable(); // URL gambar produk
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps(); // Kolom created_at dan updated_at
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
