<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //up　テーブル作成
    {
        Schema::create('favorites', function (Blueprint $table) { //favoriteテーブル作成
            $table->bigIncrements('id'); //id autoインクリメント
            $table->bigInteger('user_id')->unsigned()->index(); //外部キー、usersテーブルのidを取得(unsigned整数 インデックス作成)
            $table->bigInteger('movie_id')->unsigned()->index(); //外部キー、moviesテーブルのidを取得(unsigned整数 インデックス作成)
            $table->timestamps(); //更新時刻

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // usr_idとusersテーブルのidを連結、usersテーブルレコード削除メソッド実行時、一緒に削除
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            //movie_idとmovieテーブルのidを連結、moviesテーブルレコード削除メソッド実行時、一緒に削除
            $table->unique(['user_id','movie_id']);
            //user_idとmovie_idの組み合わせが重複しない制約
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //down削除メソッド
    {
        Schema::dropIfExists('favorites'); //ロールバック処理->favoritesテーブルの削除
    }
}
