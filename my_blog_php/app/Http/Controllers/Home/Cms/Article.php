<?php
namespace App\Http\Controllers\Home\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article as A;
use App\Models\ArticleBak;
use App\Models\Zan;

class Article extends Controller
{
	//获取文章列表
	public function ArticleListGet(Request $request,A $article)
	{
		$result = $article;
		//查询条件
		$result = isset($this->param['id']) ?
			$result->where('a_id','=',$this->param['id']):$result;
		$result = isset($this->param['u_id']) ?
			$result->where('a_u_id','=',$this->param['u_id']):$result;
		$result = isset($this->param['c_id']) ?
			$result->where('a_c_id','=',$this->param['c_id']):$result;
		$result = isset($this->param['title']) ?
			$result->where('a_title','like','%'.$this->param['title'].'%'):$result;

		//排序
		$result = $result->orderBy('a_id','desc');

		//指定字段
		if (isset($this->param['select'])) {
			$selects = explode(',',$this->param['select']);
			$selects = array_map(function($item){
				return 'a_'. $item;
			},$selects);
			$result = $result->select(...$selects);
		}

		//分页
		$size = $this->param['size'] ?? 10 ;
		$result = $result->paginate($size);

		//返回
		return $this->returnInfo($result->toArray()['data']);

	}


	//获取文章详情
	public function articleGet(Request $request,A $article)
	{
		//查询条件
		$result = $article->where('a_id',$this->param['id']);
		//指定字段
		if (isset($this->param['select'])) {
			$selects = explode(',',$this->param['select']);
			$selects = array_map(function($item){
				return 'a_'. $item;
			},$selects);
			$result = $result->select(...$selects);
		}

		$result = $result->first();

		//访问量+1
		if ($result) {
			$result->a_clicks = $result->a_clicks+1;
			$result->save();
		}

		//返回
		return $this->returnInfo($result);
	}

	//修改文章
	public function articlePut(Request $request,$id,A $article,ArticleBak $articleBak)
	{
		$param = $this->param;

		//查出文章
		$tmp = $article ->where('a_id',$id)
						->first()
						->toArray();
		if ($tmp)
			unset($tmp['a_id']);

		//修改
		$result = $article 	->where('a_id',$id)
							->update($param);


		//备份原始数据
		if ($result) {
			$articleBak->insert([
				'a_a_id'=>$id,
				'a_content'=>json_encode($tmp),
				'a_datetime'=>date('Y-m-d H:i:s'),
			]);
		}

		//返回
		$errno = $result?0:2;
		$info = $result?'修改成功！':'修改失败！';
		return $this->returnInfo([],$errno,$info);
	}

	//创建文章
	public function articlePost(Request $request,A $article)
	{
		$param = $this->param;

		//临时
		//默认作者为1
		$param['a_u_id'] = 1;
		//默认图片为http://codingwork.com/upload/pic/2b.jpg
		$param['a_pic'] = 'http://codingwork.com/upload/pic/2b.jpg';

		//默认时间
		$param['a_datetime'] = date('Y-m-d H:i:s');

		//新增数据
		$id = $article->insertGetId($param);
		//返回
		$data = $id?['a_id'=>$id]:[];
		$errno = $id?0:2;
		$info = $id?'添加成功':'添加失败';
		return $this->returnInfo($data,$errno,$info);
	}

	//点赞
	public function zanPut(Request $request,A $article,Zan $zan)
	{
		//查询用户
		
		return $this->returnInfo([]);
	}
}