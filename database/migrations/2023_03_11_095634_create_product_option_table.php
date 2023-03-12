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
        Schema::create('product_option', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->string('title');
            $table->bigInteger('different');
            $table->tinyInteger('type');
            $table->tinyInteger('order');
            $table->longText('description');
            $table->tinyInteger('prepaid');
            $table->string('opposite');
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
        Schema::dropIfExists('product_option');
    }
};
