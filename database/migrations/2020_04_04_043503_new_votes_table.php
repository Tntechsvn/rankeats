<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('votes', function (Blueprint $table) {
            if(Schema::hasTable('users')) {
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if(Schema::hasTable('businesses')) {
                $table->bigInteger('business_id')->unsigned();
                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            }
            if(Schema::hasTable('states')) {
                $table->bigInteger('state_id')->unsigned()->nullable();
                $table->foreign('state_id')->references('id')->on('states');
            }
            if(Schema::hasTable('cities')) {
                $table->bigInteger('city_id')->unsigned()->nullable();
                $table->foreign('city_id')->references('id')->on('cities');
            }
            if(Schema::hasTable('categories')) {
                $table->bigInteger('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('categories');
             }
            $table->tinyInteger('type_vote')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
