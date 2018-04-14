<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinglunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pingluns', function (Blueprint $table) {
            $table->increments('p_id')->comment('主键');
            $table->integer('p_parent_id')->defalut('0')->comment('评论父ID');
            $table->integer('p_u_id')->defalut('0')->comment('用户关联ID');
            $table->integer('p_a_id')->defalut('0')->comment('内容关联ID');
            $table->string('p_info')->defalut('')->comment('评论内容');
            $table->datetime('p_datetime')->defalut('')->comment('评论时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pingluns');
    }
}
