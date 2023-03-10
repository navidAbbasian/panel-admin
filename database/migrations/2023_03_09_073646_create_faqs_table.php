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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->bigInteger('product_id');
            $table->bigInteger('operator_id');
            $table->bigInteger('question_id');
            $table->string('user_name');
            $table->string('user_mail');
            $table->mediumText('question');
            $table->string('fake');
            $table->integer('like');
            $table->integer('dislike');
            $table->tinyInteger('notice');
            $table->tinyInteger('status');
            $table->mediumText('answer');
            $table->timestamp('question_date')->nullable();
            $table->timestamp('answer_date')->nullable();
            $table->tinyInteger('unknown');
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
        Schema::dropIfExists('faqs');
    }
};
