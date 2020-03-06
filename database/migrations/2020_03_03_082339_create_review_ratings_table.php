<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            if (Schema::hasTable('users')) {
                $table->bigInteger('id_user')->unsigned();
                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            }
            if (Schema::hasTable('reviews')) {
                $table->bigInteger('review_id')->unsigned();
                $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            }
            $table->tinyInteger('type_rate');
            $table->tinyInteger('rate');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('review_ratings');
    }
}
