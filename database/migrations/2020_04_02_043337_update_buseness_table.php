<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBusenessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('businesses')){
            Schema::table('businesses', function (Blueprint $table) {
                $table->timestamp('day_opening')->nullable()->after('total_vote');
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
         Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('day_opening');
        });
    }
}
