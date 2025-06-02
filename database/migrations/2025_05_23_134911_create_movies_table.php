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
        // movies テーブルを作成
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            // id カラムは自動増分の主キー
            // bigIncrements は、8バイトの符号なし整数を使用して自動的に増分される主キーを作成する
            $table->string('title')->nullable();
            // 動画のタイトルは任意入力なのでnullable()を使用
            // もしタイトルが入力されなかった場合、NULLが格納される
            $table->bigInteger('user_id')->unsigned()->index();
            // user_id カラムは unsigned で、インデックスを付ける
            // unsigned は、負の値を許可しないことを意味する
            $table->string('youtube_id');
            // youtube_id カラムは動画のIDを格納するためのカラム
            // ここでは、動画のIDを文字列として格納する
            $table->timestamps();
            // created_at と updated_at カラムを自動的に管理するための timestamps() メソッドを使用
            // これにより、レコードが作成された日時と更新された日時が自動的に記録される
            $table->softDeletes();
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // posts テーブルの user_id カラムは users テーブルの id カラムを参照する 
            // onDelete cascade は連動して削除する
            // $table->foreign('user_id')->references('id')->on('users');
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
