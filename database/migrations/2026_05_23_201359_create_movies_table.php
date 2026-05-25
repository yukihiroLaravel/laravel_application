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
            $table->bigIncrements('id');
            $table->string('title')->nullable(); // 動画のタイトル nullを許可する。
            $table->bigInteger('user_id')->unsigned()->index();
            //unsigned： マイナス値を許可しない、index(): 検索速度を早める

            $table->string('youtube_id');
            $table->timestamps();
            $table->softDeletes();
            // 外部キー制約 user_idとuserテーブルのidカラムは一致しなければならない
            // movieを持つuserがレコードから削除された場合、同時にそのuserが所有するmovieレコードも削除される。
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
