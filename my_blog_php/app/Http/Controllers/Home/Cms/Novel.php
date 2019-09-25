<?php
namespace App\Http\Controllers\Home\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Novel as N;
use App\Models\NovelClick;

class Novel extends Controller
{
	//获取小说列表
	public function novelListGet(Request $request,N $novel)
    {
        $result = $novel->get();
        return $this->returnInfo($result->toArray());
    }

    //增加小说
    public function novelPost(Request $request,N $novel)
    {
        $param = $this->param;

		//构建数据库数据
		$data = [];

		$data['n_id'] = $param['n_id'];
		$data['n_channel'] = $param['n_channel'];
		$data['n_identify'] = $param['n_identify'];
		$data['n_name'] = $param['n_name'];
		$data['n_datetime'] = date('Y-m-d H:i:s');

		//新增数据
		$id = $novel->insertGetId($data);
		//返回
		$result = $id?['n_id'=>$id]:[];
		$errno = $id?0:2;
		$info = $id?'添加成功':'添加失败';
		return $this->returnInfo($result,$errno,$info);
    }

    //删除小说
    public function novelDelete(Request $request,N $novel)
    {
        $param = $this->param;
        
        $result = $novel->destroy($param['n_id']);
        $errno = $result?0:2;
		$info = $result?'删除成功':'删除失败';
        return $this->returnInfo($result,$errno,$info);
    }

    //
    
}