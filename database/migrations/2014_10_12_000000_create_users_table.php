<?php

use Illuminate\Database\Migrations\Migration; //マイグレーションを定義するためのクラス
use Illuminate\Database\Schema\Blueprint; //テーブル構成を定義するためのクラス
use Illuminate\Support\Facades\Schema; //テーブル作成、削除を定義するためのクラス
// ↑ reactでいう import { useState , useEffect } from 'react'; のようなもの
// laravelで必要な機能やクラスを使用できるように読み込む
//クラス　オブジェクト指向で使用されるデータと処理をまとめたもの　【設計図】
//機能    programにおける具体的な動作や処理　【具体的な動作、処理】

class CreateUsersTable extends Migration
 //クラス名【CreateUserTable】　
 //マイグレーションを継承（マイグレーションの処理）
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //マイグレーションの実行処理 (up)メソッドで作成処理
    {
        Schema::create('users', function (Blueprint $table) {
            //Schema でuserテーブルを作成
            // ?Blueprint マイグレーションで使用されるクラス、データベースの構造を定義するために利用　下記記載のものの設計図
            //　　追記⇒　laravelでデータベースの構造や変更を定義する際にデフォルト使用するものと認識
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
