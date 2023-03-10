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
        Schema::create('customers_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->string('title');
            $table->string('link');
            $table->mediumText('description');
            $table->string('products');
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
        Schema::dropIfExists('customers_lists');
    }
};
