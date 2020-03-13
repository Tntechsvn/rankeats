<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            if (Schema::hasTable('businesses')) {
                $table->bigInteger('business_id')->unsigned()->nullable();
                $table->foreign('business_id')->references('id')->on('businesses')->onDelete('set null');
            }
            if (Schema::hasTable('plan_details')) {
                $table->bigInteger('plan_detail_id')->unsigned()->nullable();
                $table->foreign('plan_detail_id')->references('id')->on('plan_details')->onDelete('set null');
            }
            $table->timestamp('active_date')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('advertisements');
    }
}
