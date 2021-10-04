<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->string('name')->comment('氏名');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable()->comment('メールアドレス確認日時');
            $table->string('password')->comment('パスワード');
            $table->tinyInteger('role')->default(\App\Administrator::ROLE_USER)->comment('権限'); // 10: 一般, 90: 管理者
            $table->rememberToken()->comment('ログイン状態記憶トークン');
            $table->dateTime('last_logged_in_at')->nullable()->comment('最終ログイン日時');
            $table->softDeletes()->comment('削除日時');
            $table->timestamp('created_at')->nullable()->comment('作成日時');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `administrators` COMMENT '管理者テーブル'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
