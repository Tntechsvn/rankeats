<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            if (Schema::hasTable('users')) {
                $table->bigInteger('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            }
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            if (Schema::hasTable('locations')) {
                $table->bigInteger('location_id')->unsigned()->nullable();
                $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
            }
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('url_img')->nullable();
            $table->string('tags')->nullable();
            $table->bigInteger('total_rate')->unsigned();
            $table->bigInteger('total_vote')->unsigned();
            $table->timestamp('activated_on')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
