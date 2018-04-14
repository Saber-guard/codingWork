<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('u_id')->comment('主键');
            $table->string('u_account')->defalut('')->comment('账号');
            $table->string('u_pwd')->defalut('')->comment('密码');
            $table->string('u_nickname')->defalut('')->comment('昵称');
            $table->string('u_info')->defalut('')->comment('人生格言');
            $table->string('u_email')->defalut('')->comment('邮箱');
            $table->datetime('u_datetime')->defalut('')->comment('注册时间');
            $table->integer('u_type')->defalut('0')->comment('用户类型（普通用户/管理员）');
            $table->string('u_pic')->defalut('')->comment('头像');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
