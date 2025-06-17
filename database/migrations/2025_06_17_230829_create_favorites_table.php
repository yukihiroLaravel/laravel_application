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
        if (Schema::hasTable('favorites')) {
            return;
        }
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('movie_id')->unsigned()->index();
            $table->timestamps();
            // 外部キー制約とは、親テーブル（参照されるテーブル）のデータが変更された場合に、子テーブル（参照するテーブル）のデータも適切に更新または削除されるようにすることで、データの不整合を防ぐ
            // 参照先のテーブル(user_id,movie_id)とカラム(id)を指定
            // onDelete('cascade')で、参照先のレコード（ユーザー情報や動画）が削除された場合に、このテーブルの関連レコード（いいね！）も削除されるように設定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            // ユニーク制約を設定することで、同じユーザーが同じ動画に複数回いいね！できないようにする
            $table->unique(['user_id','movie_id']);
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
