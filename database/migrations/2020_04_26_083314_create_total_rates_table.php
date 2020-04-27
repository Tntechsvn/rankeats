<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            if (Schema::hasTable('businesses')) {
                $table->bigInteger('business_id')->unsigned()->nullable();
                $table->foreign('business_id')->references('id')->on('businesses');
            }
            if(Schema::hasTable('categories')) {
                $table->bigInteger('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('categories');
            }
            $table->text('city')->nullable();            
            $table->text('state')->nullable();
            $table->tinyInteger('type_rate');
            $table->bigInteger('total_rate')->unsigned()->default(0);
            $table->bigInteger('total_vote')->unsigned()->default(0);        
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
        Schema::dropIfExists('total_rates');
    }
}
