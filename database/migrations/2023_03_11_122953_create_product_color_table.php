<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_color', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('color_id');
            $table->string('category');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('order');
            $table->tinyInteger('default');
            $table->integer('off');
            $table->tinyInteger('amazing');
            $table->bigInteger('gift');
            $table->bigInteger('package');
            $table->bigInteger('package_color');
            $table->integer('package_price');
            $table->bigInteger('createdBy');
            $table->bigInteger('editedBy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_color');
    }
};
