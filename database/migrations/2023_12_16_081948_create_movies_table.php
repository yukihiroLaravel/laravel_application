<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');//動画ID
            $table->string('title')->nullable();//タイトル、空欄許可
            $table->bigInteger('user_id')->unsigned()->index();//unsignedはIDのマイナス禁止。indexは検索速度を早める効果がある
            $table->string('youtube_id');//youtube動画ID
            $table->timestamps();//動画の作成、更新時間
            $table->softDeletes();//削除時間
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//usersのidとuser_idは同じでなければならない、usersが削除されたらusers_idも連動して削除される
        });
    }

    /**
     * Reverse the migrations.
     * 

     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
