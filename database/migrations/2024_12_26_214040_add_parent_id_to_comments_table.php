<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // parent_idカラムを追加
            $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            
            // 外部キー制約を追加（親コメントが削除された場合、子コメントも削除される）
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // parent_idカラムを削除
            $table->dropForeign(['parent_id']); // 外部キー制約を削除
            $table->dropColumn('parent_id'); // parent_idカラムを削除
        });
    }
}
