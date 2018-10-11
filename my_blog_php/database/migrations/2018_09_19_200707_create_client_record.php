<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_records', function (Blueprint $table) {
            $table->increments('cr_id')->comment('主键');
            $table->string('cr_ip')->defalut('')->comment('IP');
            $table->string('cr_user_agent')->defalut('')->comment('useragent');
            $table->string('cr_client_id')->defalut('')->comment('客户端ID');
            $table->datetime('cr_datetime')->defalut('')->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('client_records');
    }
}
