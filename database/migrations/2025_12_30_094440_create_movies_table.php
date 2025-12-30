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
        // Schema::create('movies', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->timestamps();
        // });
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('youtube_id');
            $table->timestamps();
            $table->softDeletes();
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    // moviesテーブルのカラムとして下記のようなものを指定します。
    // カラム ー 動画ID、タイトル、ユーザID、YouTube動画ID、動画情報の作成時間、動画情報の更新時間、動画情報の削除時間
    // タイトルとは、動画に名付けたい任意のタイトルを意味します。
    // YouTube動画IDとは、登録することになるYouTube動画に固有の11文字の識別文字列のことです。

    // unsigned() ー マイナスの数値が保存されないように制限しています。
    // index() ー これを付けることで、user_idカラムへの検索速度を早めることができます。
    // 動画を所有しているユーザ情報を元に動画に検索を掛けることも多くなるので、
    // 特にこのカラムへの検索速度を高める意味合いでindex()を付けています。
    // さらに、「// 外部キー制約」と書いてある真下に記述されている部分のコードに着目してみて下さい。
    // 1対多の関係では、ここがとても重要なポイントです。実はこのコードは下記のような制限を持たせるために書かれています。
    // 「moviesテーブルのuser_idカラム」 と 「usersテーブルのidカラム」 は一致しなければならない
    // （ = users.idに一致しないmovies.user_idは作れない）movieを持つuserがレコードから削除された場合は、
    // userレコードと同時にそのuserが所有するmovieレコードも削除される

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
