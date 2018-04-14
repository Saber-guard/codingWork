<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zans', function (Blueprint $table) {
            $table->increments('z_id')->comment('主键');
            $table->integer('z_u_id')->defalut('0')->comment('用户关联ID');
            $table->integer('z_a_id')->defalut('0')->comment('内容关联ID');
            $table->datetime('z_datetime')->defalut('')->comment('点赞时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('zans');
    }
}
