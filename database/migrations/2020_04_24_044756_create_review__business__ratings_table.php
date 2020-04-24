<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewBusinessRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review__business__ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            if (Schema::hasTable('users')) {
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (Schema::hasTable('reviews')) {
                $table->bigInteger('review_id')->unsigned();
                $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            }
            $table->bigInteger('id_rate_from')->unsigned();/*storage id order or id booking depends type rate*/
            $table->tinyInteger('type_rate');
            $table->tinyInteger('rate');
            $table->text('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('review__business__ratings');
    }
}
