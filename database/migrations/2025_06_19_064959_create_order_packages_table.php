<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_packages', function (Blueprint $table) {
            $table->id('order_package_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('menu_package_id');
            $table->unsignedBigInteger('chef_id')->nullable();
            $table->integer('quantity');
            $table->string('note')->nullable();
            $table->enum('status', ['pending', 'preparing', 'ready', 'served', 'cancelled'])->default('pending');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('menu_package_id')->references('menu_id')->on('menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_packages');
    }
};
