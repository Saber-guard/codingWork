<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleBak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_baks', function (Blueprint $table) {
            $table->increments('a_id')->comment('主键');
            $table->integer('a_a_id')->defalut('0')->comment('文章关联ID');
            $table->json('a_content')->defalut('')->comment('文章备份内容');
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
        Schema::drop('article_bak');
    }
}
