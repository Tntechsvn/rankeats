<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnCitystateTableAdvertisements extends Migration
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
                if(Schema::hasTable('states')) {
                    $table->bigInteger('state_id')->unsigned()->nullable()->after('business_id');
                    $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
                }
                if(Schema::hasTable('cities')) {
                    $table->bigInteger('city_id')->unsigned()->nullable()->after('state_id');
                    $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
                }
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
            $table->dropForeign('advertisements_state_id_foreign');
            $table->dropColumn('state_id');
            $table->dropForeign('advertisements_city_id_foreign');
            $table->dropColumn('city_id');
        });
    }
}
