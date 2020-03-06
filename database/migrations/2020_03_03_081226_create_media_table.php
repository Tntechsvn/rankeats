<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            if (Schema::hasTable('users')) {
                $table->bigInteger('id_user')->unsigned()->nullable();
                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            }
            $table->string('type_media');
            $table->text('url');
            $table->string('thumbnail')->nullable();
            $table->tinyInteger('type');
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
        Schema::dropIfExists('media');
    }
}
