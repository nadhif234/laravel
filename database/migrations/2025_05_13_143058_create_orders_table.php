<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis
            $table->unsignedBigInteger('customer_id'); // Kolom customer_id yang sesuai
            $table->date('order_date'); // Kolom untuk tanggal order
            $table->string('status'); // Kolom status order
            $table->timestamps(); // Kolom created_at dan updated_at

            // Relasi ke tabel customers
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
