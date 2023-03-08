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
        Schema::create('config', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner');
            $table->string('title');
            $table->string('keywords');
            $table->string('description');
            $table->integer('gift_bones');
            $table->integer('ref_bones');
            $table->string('address');
            $table->string('email');
            $table->string('tel');
            $table->string('logo');
            $table->string('logo_alt');
            $table->string('logo_title');
            $table->string('aparat');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('telegram');
            $table->string('instagram');
            $table->string('whatsapp');
            $table->string('enamad');
            $table->string('reza');
            $table->string('membership');
            $table->string('banner');
            $table->string('banner_link');
            $table->string('org_color');
            $table->string('org_hover_color');
            $table->string('light_color');
            $table->string('secound_color');
            $table->string('secound_hover_color');
            $table->tinyInteger('specials_status');
            $table->tinyInteger('gift_status');
            $table->tinyInteger('consult_status');
            $table->string('fave_icon');
            $table->string('freecargo');
            $table->string('shipment_price');
            $table->string('account_owner');
            $table->string('owner_number');
            $table->string('createdBy');
            $table->string('editedBy')->nullable();
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
        Schema::dropIfExists('config');
    }
};
