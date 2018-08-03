<?php
namespace App\Http\Controllers\Home\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor as V;

class Visitor extends Controller
{
	//获取访问量
	public function visitorNumGet(V $visitor)
	{
		$num = $visitor->count();
		return $this->returnInfo(['num'=>$num?$num:0],0);
	}

	//添加访问记录
	public function visitorPost(V $visitor)
	{
        //构建数据
        $data = [];
        $data['v_ip'] = $_SERVER['REMOTE_ADDR'];
        $data['v_date'] = date('Y-m-d');
        $data['v_datetime'] = date('Y-m-d H:i:s');

        $visitor = new Visitor;
        $record = $visitor  ->where('v_ip','=',$data['v_ip'])
                            ->where('v_date','=',$data['v_date'])
                            ->first();
        if (!$record) {
            $visitor->insertGetId($data);
        }

        $num = $visitor->count();
		return $this->returnInfo(['num'=>$num?$num:0],0);
	}
}