<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_reactions', function (Blueprint $table) {
           if(Schema::hasTable('users')) {
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if(Schema::hasTable('reviews')) {
                $table->bigInteger('review_id')->unsigned();
                $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            }
            
            $table->tinyInteger('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_reactions');
    }
}
