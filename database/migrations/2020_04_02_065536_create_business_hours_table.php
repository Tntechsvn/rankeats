<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_hours', function (Blueprint $table){
            if(Schema::hasTable('businesses')) {
                $table->bigInteger('business_id')->unsigned()->nullable();
                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('set null');
            }
            $table->string('business_days')->nullable();
            $table->string('open_from')->nullable();
            $table->string('open_till')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_hours');
    }
}
