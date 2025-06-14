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
            $table->string('title')->nullable();
            // unsignedはマイナス値を許容しないために入力
            // indexは検索を高速化するために入力
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('youtube_id');
            $table->timestamps();
            $table->softDeletes();
            // 外部キー制約
            // user_idはusersテーブルのidを参照し、削除する時には該当のuser_IDに関連するmoviesも削除される
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
