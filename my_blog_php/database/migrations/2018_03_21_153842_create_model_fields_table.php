<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_fields', function (Blueprint $table) {
            $table->increments('mf_id')->comment('主键');
            $table->integer('mf_m_id')->defalut('0')->comment('模型关联字段');
            $table->string('mf_name')->defalut('')->comment('字段名称');
            $table->string('mf_field_name')->defalut('')->comment('数据库字段名称');
            $table->integer('mf_type')->defalut('0')->comment('字段类型');
            $table->string('mf_default')->defalut('')->comment('字段默认值');
            $table->integer('mf_length')->defalut('0')->comment('字段长度');
            $table->string('mf_info')->defalut('')->comment('字段注释');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('model_fields');
    }
}
