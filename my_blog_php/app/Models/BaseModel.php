<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	//定义数据库连接
	//protected $connection = 'connection-name';
	//定义表名
	//protected $table = '';
	//定义主键
	//protected $primaryKey = '';
	//关闭时间戳维护
    public $timestamps = false;
    //定义关联
}
