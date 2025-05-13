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
    Schema::table('customers', function (Blueprint $table) {
        $table->string('phone')->default('N/A')->change(); // Set nilai default untuk kolom phone
    });
}

public function down()
{
    Schema::table('customers', function (Blueprint $table) {
        $table->string('phone')->nullable(false)->change(); // Kembalikan kolom ke kondisi semula jika migration dibatalkan
    });
}

};
