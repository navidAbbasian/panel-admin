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
        Schema::create('consult', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('communication_method');
            $table->tinyInteger('consult_method');
            $table->tinyInteger('is_user');
            $table->foreignId('user_id')->references('id')->on('user');
            $table->mediumText('report');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('consult');
    }
};
