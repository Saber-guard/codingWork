<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('a_id')->comment('主键');
            $table->integer('a_u_id')->defalut('0')->comment('用户关联ID');
            $table->integer('a_c_id')->defalut('0')->comment('栏目关联ID');
            $table->string('a_title')->defalut('')->comment('标题');
            $table->text('a_text')->defalut('')->comment('文本');
            $table->string('a_pic')->defalut('')->comment('缩略图');
            $table->string('a_describe')->defalut('')->comment('简介');
            $table->datetime('a_datetime')->defalut('')->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
