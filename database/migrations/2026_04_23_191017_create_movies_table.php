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
            $table->bigIncrements('id'); // 1ずつ自動増加
            $table->string('title')->nullable(); // nullable:空欄を許可
            $table->bigInteger('user_id')->unsigned()->index(); // unsigned:マイナスを許可しない index()：検索速度が速くなる
            $table->string('youtube_id');
            $table->timestamps(); // 作成時間と更新時間
            $table->softDeletes(); // 論理削除された時間
            // 外部キー制約
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
