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
        // favoritesテーブルを作成
        // ユーザが動画をお気に入り登録するためのテーブル
        // ユーザIDと動画IDを外部キーとして持ち、ユーザと動画のリレーションを表現
        // また、ユーザIDと動画IDの組み合わせは一意であることを保証するために、unique制約を設定

        // Schemaファサードを使用して、favoritesテーブルを作成
        Schema::create('favorites', function (Blueprint $table) {
            // idカラムは自動増分の主キー
            $table->bigIncrements('id');
            // user_idカラムはunsignedのbigInteger型で、usersテーブルのidを参照する
            $table->bigInteger('user_id')->unsigned()->index();
            // movie_idカラムはunsignedのbigInteger型で、moviesテーブルのidを参照する
            $table->bigInteger('movie_id')->unsigned()->index();
            // created_atカラムはタイムスタンプ型で、レコードの作成日時を自動的に記録する
            $table->timestamps();
            // 外部キー制約
            // user_idはusersテーブルのidを参照し、削除時には関連するいいねも削除される
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // movie_idはmoviesテーブルのidを参照し、削除時には関連するいいねも削除される
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            // ユーザIDと動画IDの組み合わせを一意にする
            // これにより、同じユーザが同じ動画を複数回お気に入り登録できないようにする
            // つまり、ユーザが特定の動画をお気に入りに登録することは一度だけ可能
            // もし、同じユーザが同じ動画を再度お気に入り登録しようとすると、エラーが発生する
            // これにより、データの整合性が保たれ、重複したお気に入り登録を防ぐことができる
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