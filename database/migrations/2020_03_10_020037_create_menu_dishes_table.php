<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('menu_dishes')) {
            Schema::create('menu_dishes', function (Blueprint $table) {
                if (Schema::hasTable('menus')) {
                    $table->bigInteger('menu_id')->unsigned();
                    $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
                }
                if (Schema::hasTable('dishes')) {
                    $table->bigInteger('dish_id')->unsigned();
                    $table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
                }
                $table->primary(['menu_id', 'dish_id']);
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
        Schema::dropIfExists('menu_dishes');
    }
}
