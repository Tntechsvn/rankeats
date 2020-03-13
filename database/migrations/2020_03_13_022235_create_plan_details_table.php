<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pd_plan_id')->unsigned();
            $table->foreign('pd_plan_id')->references('id')->on('payment_plans')->onDelete('cascade');
            $table->bigInteger('pd_days')->unsigned();
            $table->float('pd_cost')->unsigned();
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
        Schema::dropIfExists('plan_details');
    }
}
