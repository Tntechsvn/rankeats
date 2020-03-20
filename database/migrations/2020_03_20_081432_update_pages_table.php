<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->tinyInteger('page_title')->unsigned()->after('page_content');
                $table->tinyInteger('slug')->unsigned()->after('page_title');
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
         Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('page_title');
            $table->dropColumn('slug');
        });
    }
}
