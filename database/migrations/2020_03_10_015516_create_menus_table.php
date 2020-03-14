<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if (! Schema::hasTable('menus')) {
            Schema::create('menus', function (Blueprint $table) {
                $table->bigIncrements('id');
                if (Schema::hasTable('businesses')) {
                    $table->bigInteger('business_id')->unsigned();
                    $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
                }
                $table->string('menu_name');
                $table->bigInteger('menu_parent')->default(0);
                if (Schema::hasTable('media')) {
                    $table->bigInteger('id_image')->unsigned()->nullable();
                    $table->foreign('id_image')->references('id')->on('media')->onDelete('set null');
                }
                $table->text('description')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('menus');
    }
}
