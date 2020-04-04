<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnImageTableAdvertisements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('advertisements')){
            Schema::table('advertisements', function (Blueprint $table) {
                $table->string('image')->after('plan_detail_id');
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
        
        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
