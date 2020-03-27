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
                $table->text('page_title')->after('page_content');
                $table->tinyInteger('ordinarily')->unsigned()->after('page_title');
                $table->text('slug')->after('ordinarily');
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
            $table->dropColumn('ordinarily');
            $table->dropColumn('slug');
        });
    }
}
