<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            // Pastikan Anda memiliki tabel 'users' sebelum menjalankan migrasi ini.
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reservasi_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->enum('order_type', ['Dine In', 'Take Away', 'Delivery']);
            $table->integer('total_payment');
            $table->timestamps();

            // Contoh foreign key constraint. Hilangkan komentar jika Anda memiliki tabel 'users'.
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
