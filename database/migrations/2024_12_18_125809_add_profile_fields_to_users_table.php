<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->unique()->nullable();
            $table->enum('gender', ['male', 'female', 'other','unknown'])->default('unknown');
            $table->string('profile_picture')->nullable(); // デフォルト写真を管理
            $table->text('self_introduction')->nullable(); // 自己紹介用カラムを追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nickname', 'gender', 'profile_picture','self_introduction']);
        });
    }
}


