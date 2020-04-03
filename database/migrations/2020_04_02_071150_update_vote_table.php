<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('votes')){
            Schema::table('votes', function (Blueprint $table) {
                if(Schema::hasTable('states')) {
                    $table->bigInteger('state_id')->unsigned()->nullable()->after('business_id');
                    $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
                }
                if(Schema::hasTable('cities')) {
                    $table->bigInteger('city_id')->unsigned()->nullable()->after('state_id');
                    $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
                }
                $table->tinyInteger('type_vote')->nullable()->after('state_id');
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
        Schema::table('votes', function (Blueprint $table) {
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
            $table->dropColumn('type_vote');
        });
    }
}
