<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_tag', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ad_id');
            $table->foreign('ad_id')->on('ads')->references('id');

            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->on('tags')->references('id');

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
        Schema::dropIfExists('ad_tag');
    }
}
