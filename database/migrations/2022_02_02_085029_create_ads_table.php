<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('type');
            $table->string('title');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedBigInteger('advertiser_id');
            $table->foreign('advertiser_id')->references('id')->on('users');


            $table->text('description')->nullable();
            $table->date('start_date');

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
        Schema::dropIfExists('ads');
    }
}
