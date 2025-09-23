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
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();//マイナス値を許容しないようにunsigned関数を入れる
            $table->bigInteger('movie_id')->unsigned()->index();
            $table->timestamps();
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//userが削除されたらいいねがなくなる
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');//movieが削除されたらいいねがなくなる
            $table->unique(['user_id','movie_id']);//同じユーザが同じmovieをいいねしないように
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
