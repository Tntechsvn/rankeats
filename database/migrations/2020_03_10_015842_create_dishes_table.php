<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('dishes')) {
            Schema::create('dishes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                if (Schema::hasTable('businesses')) {
                    $table->bigInteger('business_id')->unsigned();
                    $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
                }
                if (Schema::hasTable('media')) {
                    $table->bigInteger('id_thumbnail')->unsigned()->nullable();
                    $table->foreign('id_thumbnail')->references('id')->on('media')->onDelete('set null');
                }
                $table->text('list_id_media')->nullable();
                /*$table->bigInteger('price')->unsigned()->nullable();*/
                $table->text('description')->nullable();
                $table->bigInteger('total_rate')->unsigned()->default(0);
                $table->bigInteger('total_vote')->unsigned()->default(0);
                $table->timestamps();
                $table->timestamp('deleted_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}
