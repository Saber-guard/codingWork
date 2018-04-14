<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('c_id')->comment('主键');
            $table->integer('c_parent_id')->defalut('0')->comment('父ID');
            $table->string('c_parent_id_path')->defalut('')->comment('父ID路径');
            $table->string('c_title')->defalut('')->comment('标题');
            $table->string('c_alias')->defalut('')->comment('别名');
            $table->string('c_info')->defalut('')->comment('栏目介绍');
            $table->integer('c_m_id')->defalut('0')->comment('关联模型ID');
            $table->string('c_pic')->defalut('')->comment('栏目图片');
            $table->datetime('c_datetime')->comment('创建时间');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
