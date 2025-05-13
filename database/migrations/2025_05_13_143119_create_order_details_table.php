<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis
            $table->unsignedBigInteger('order_id'); // Kolom order_id yang sesuai
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade'); // Relasi dengan tabel orders
            $table->decimal('subtotal', 10, 2); // Kolom subtotal
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
