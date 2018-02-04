<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 题库分类表
        Schema::create('cate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->comment('分类名称');
            $table->integer('create_user_id')->comment('添加管理员ID');
            $table->integer('update_user_id')->comment('更新管理员ID');
            $table->timestamps();
            $table->softDeletes();
        });

        // 题库
        Schema::create('question', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cate_id')->comment('分类ID');
            $table->string('title', 255)->comment('题干');
            $table->integer('score')->comment('分数');
            $table->integer('create_user_id')->comment('添加管理员ID');
            $table->integer('update_user_id')->comment('更新管理员ID');
            $table->timestamps();
            $table->softDeletes();
        });

        // 答案
        Schema::create('answer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->comment('题目ID');
            $table->string('option', 255)->comment('选项');
            $table->boolean('is_right')->default(0)->comment('是否正确');
            $table->integer('create_user_id')->comment('添加管理员ID');
            $table->integer('update_user_id')->comment('更新管理员ID');
            $table->timestamps();
            $table->softDeletes();
        });

        // 用户
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname', 32)->comment('昵称');
            $table->string('avatar', 255)->default('')->comment('头像');
            $table->integer('score')->comment('得分');
            $table->integer('count')->comment('PK次数');
            $table->integer('win_count')->comment('胜利次数');
            $table->integer('lose_count')->comment('失败次数');
            $table->integer('draw_count')->comment('平局次数');
            $table->timestamps();
            $table->softDeletes();
        });

        // pk轮次
        Schema::create('round', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_member_id')->comment('PK一方（主）');
            $table->integer('away_member_id')->comment('PK另一方（客）');
            $table->integer('win_member_id')->comment('获胜用户ID，平局为0');
            $table->integer('score')->comment('胜利者得分，平局为0');
            $table->timestamps();
        });

        // 记录
        Schema::create('record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('round_id')->comment('轮次ID');
            $table->string('question', 255)->comment('题目ID');
            $table->string('home_answer', 255)->comment('答案（主）');
            $table->boolean('home_is_right')->comment('是否正确（主）');
            $table->integer('home_score')->comment('得分（主）');
            $table->string('away_answer', 255)->comment('答案（客）');
            $table->boolean('away_is_right')->comment('是否正确（客）');
            $table->integer('away_score')->comment('得分（客）');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cate', 'question', 'answer', 'member', 'round', 'record');
    }
}
