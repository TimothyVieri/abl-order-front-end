<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('name');
            $table->string('category'); // e.g., 'Main Course', 'Drink'
            $table->unsignedBigInteger('menu_package_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('image_path')->nullable(); // To store image URL
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
