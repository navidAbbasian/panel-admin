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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('meta_title');
            $table->string('meta_desc');
            $table->string('slug');
            $table->string('model');
            $table->bigInteger('brand');
            $table->longText('description');
            $table->bigInteger('tax_class');
            $table->string('categories');
            $table->bigInteger('like');
            $table->integer('price');
            $table->integer('quantity');
            $table->tinyInteger('status');
            $table->timestamp('publishDate')->nullable();
            $table->integer('weight');
            $table->integer('length');
            $table->integer('height');
            $table->integer('score');
            $table->string('tags');
            $table->string('option_title');
            $table->integer('sale');
            $table->integer('view');
            $table->mediumText('video');
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
        Schema::dropIfExists('products');
    }
};
