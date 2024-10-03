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
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) { //favoriteテーブルを作成。依存性注入で$tableインスタンスが生成される。
            $table->bigIncrements('id');//主キーカラム
            $table->bigInteger('user_id')->unsigned()->index();//負の符号を持たない検索しやすいカラム
            $table->bigInteger('movie_id')->unsigned()->index();//上記と同じ
            $table->timestamps();//メソッドが実行された時間。（いいね押した時間）
            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//子テーブル(favorite)のuser_idカラムと親テーブル(users)のidカラムで外部キー制約を結んでいる。
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');//上記のmovies版。
            $table->unique(['user_id','movie_id']);//ユーザーが一つの動画に対していいねできるのは一回のみ。（一つの動画にいいねは何回もできないよ）
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
