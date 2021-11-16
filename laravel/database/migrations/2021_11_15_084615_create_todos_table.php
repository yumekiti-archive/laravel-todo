<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();                                               // id
            $table->timestamps();                                       // 作成日
            $table->char('title', 100);                                 // タイトル
            $table->string('detail')->nullable();                       // 詳細
            $table->boolean('state')->default(false);                   // 達成したか
            $table->softDeletes();                                      // 論理削除
            $table->unsignedBigInteger('user_id');                      // userのidがBigIntegerなのでこちらもBigIntegerを使う
            $table->foreign('user_id')->references('id')->on('users');  // user外部キー制約
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
