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
            $table->string('advertisemen_1')->nullable();
            $table->string('advertisemen_2')->nullable();
            $table->string('advertisemen_3')->nullable();
            if (Schema::hasTable('business')) {
                $table->bigInteger('business_id')->unsigned()->nullable();
                $table->foreign('business_id')->references('id')->on('business')->onDelete('set null');
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
