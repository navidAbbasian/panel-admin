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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('operator_id');
            $table->string('username');
            $table->mediumText('comment');
            $table->mediumText('answer');
            $table->mediumText('goods');
            $table->mediumText('bads');
            $table->tinyInteger('offer');
            $table->tinyInteger('status');
            $table->bigInteger('like');
            $table->bigInteger('dislike');
            $table->tinyInteger('unknown');
            $table->tinyInteger('buyed');
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
        Schema::dropIfExists('comments');
    }
};
