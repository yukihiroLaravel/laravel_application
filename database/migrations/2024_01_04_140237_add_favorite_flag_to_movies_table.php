<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFavoriteFlagToMoviesTable extends Migration
{
    /**
     * マイグレーションを実行する。
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->boolean('favorite_flag')->default(true);  
        });
    }

    /**
     * マイグレーションを巻き戻す。
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('favorite_flag');
        });
    }
}
