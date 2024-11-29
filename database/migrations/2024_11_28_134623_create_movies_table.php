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
            // IDが自動で増加していくカラム

            $table->string('title')->nullable();
            //動画のタイトルを指示するカラム
            //nullable()とあるので、空欄でもデータベースに保存されるということ

            $table->bigInteger('user_id')->unsigned()->index();

            //index()は、インデックスを作成することで、テーブル内のデータ検索速度が大幅に向上させるメソッド
            //インデックスを作成する = データベースの特定のカラム（今回は'user_id'）に対して、検索やアクセスを効率化するためのデータ構造を作ること

            $table->string('youtube_id');
            $table->timestamps();
            $table->softDeletes();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //「moviesテーブルのuser_idカラム」 と 「usersテーブルのidカラム」 は一致しなければならない（ = users.idに一致しないmovies.user_idは作れない）

            //foreignは「外部」という意味。foreign('user_id')で'user_id'を外部カラムと指定している。
            //references('id')->on('users')で、'users'テーブルの'id'カラムを参照している
            //つまり'users'テーブルの'id'カラムの通して、'user_id'に関わっている。

            //onDelete('cascade')は、movieを持つuserがレコードから削除された場合は、userレコードと同時にそのuserが所有するmovieレコードも削除される

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
