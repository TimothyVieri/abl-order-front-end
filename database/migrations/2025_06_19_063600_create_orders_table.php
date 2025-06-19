<?php

// File: database/migrations/YYYY_MM_DD_HHMMSS_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reservasi_id')->nullable();

            // --- PERUBAHAN DI SINI ---
            $table->string('event_id')->nullable(); // Diubah dari integer ke string
            $table->string('voucher_id')->nullable(); // Diubah dari integer ke string

            $table->enum('order_type', ['Dine In', 'Take Away', 'Delivery']);
            $table->integer('total_payment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
