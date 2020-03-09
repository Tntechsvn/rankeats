<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('businesses_categories')) {
            Schema::create('businesses_categories', function (Blueprint $table) {
                if (Schema::hasTable('businesses')) {
                    $table->bigInteger('business_id')->unsigned();
                    $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
                }
                if (Schema::hasTable('categories')) {
                    $table->bigInteger('cate_id')->unsigned();
                    $table->foreign('cate_id')->references('id')->on('categories')->onDelete('cascade');
                }
                $table->primary(['business_id', 'cate_id']);
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
        Schema::dropIfExists('businesses_categories');
    }
}
