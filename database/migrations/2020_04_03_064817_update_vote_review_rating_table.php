<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVoteReviewRatingTable extends Migration
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
                if(Schema::hasTable('categories')) {
                    $table->bigInteger('category_id')->unsigned()->nullable()->after('business_id');
                    $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
                }
            });
        }
        
        if(Schema::hasTable('review_ratings')){
            Schema::table('review_ratings', function (Blueprint $table) {
                if(Schema::hasTable('categories')) {
                    $table->bigInteger('category_id')->unsigned()->nullable()->after('id_rate_from');
                    $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
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
        Schema::table('votes', function (Blueprint $table) {
            $table->dropColumn('category_id');
           
        });
        Schema::table('review_ratings', function (Blueprint $table) {
            $table->dropColumn('category_id');
           
        });
    }
}
