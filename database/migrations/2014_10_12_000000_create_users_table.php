<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //up テーブル新規作成
    { //Schema データベースを管理のクラス
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique(); //unique 重複を許さない
            $table->timestamp('email_verified_at')->nullable(); // nullable nullを許可
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); //コード追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //down 削除
    {
        Schema::dropIfExists('users'); // マイグレーションで誤って更新した際の操作を戻す（ロールバック）コード
    }
}
