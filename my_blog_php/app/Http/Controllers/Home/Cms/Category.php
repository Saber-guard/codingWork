<?php
namespace App\Http\Controllers\Home\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as C;

class Category extends Controller
{
	//获取栏目列表
	public function categoryListGet(Request $request,C $category)
	{

		$result = $category;
		//查询条件
		$result = isset($this->param['title']) ?
			$result->where('c_title','like','%'.$this->param['title'].'%'):$result;
		$result = isset($this->param['parent']) ?
			$result->where('c_parent_id','=',$this->param['parent']):$result;
		$result = isset($this->param['parent_path']) ?
			$result->where('c_parent_id_path','like','%|'.$this->param['parent_path'].'|%'):$result;
		//指定字段
		if (isset($this->param['select'])) {
			$selects = explode(',',$this->param['select']);
			$selects = array_map(function($item){
				return 'c_'. $item;
			},$selects);
			$result = $result->select(...$selects);
		}
		//分页
		$size = $this->param['size'] ?? 10 ;
		$result = $result->paginate($size);

		//返回
		return $this->returnInfo($result->toArray()['data']);
	}

	//获取栏目详情
	public function categoryGet()
	{

	}


}