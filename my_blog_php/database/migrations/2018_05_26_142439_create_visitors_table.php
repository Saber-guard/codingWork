<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('v_id')->comment('主键');
            $table->string('v_ip')->defalut('')->comment('IP');
            $table->datetime('v_datetime')->defalut('')->comment('访问时间');
            $table->date('v_date')->defalut('')->comment('访问日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('visitors');
    }
}
