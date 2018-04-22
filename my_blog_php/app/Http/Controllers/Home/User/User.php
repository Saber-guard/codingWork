<?php
namespace App\Http\Controllers\Home\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as U;

class User extends Controller
{
	//添加用户
	public function userPost(Request $request,U $user)
	{
		$param = $this->param;
		$id = 0;
		if (isset($param['u_account']) && $param['u_account']) {
			//临时
			//默认昵称
			$param['u_nickname'] = $param['u_account'];
			//邮箱
			$param['u_email'] = $param['u_account'];
			//简介
			$param['u_info'] = '';
			//注册日期
			$param['u_datetime'] = date('Y-m-d H:i:s');
			//用户类型
			$param['u_type'] = 0;
			//头像
			$param['u_pic'] = '';

			//新增数据
			$id = $user->insertGetId($param);
		}

		//返回
		$data = $id?['u_id'=>$id]:[];
		$errno = $id?0:2;
		$info = $id?'注册成功':'注册失败';
		return $this->returnInfo($data,$errno,$info);
	}

	//获取授权(即登录)
	public function accessPost(Request $request,U $user)
	{
		$param = $this->param;
		//验证
		$user = $user->where('u_account','=',$this->param['account'])
					   ->first();
		if (!$user) {
			return $this->returnInfo([],2,'账号不存在！');
		}
		if ($user->u_pwd != $param['pwd']) {
			return $this->returnInfo([],2,'账号或密码错误！');
		}

		//保存用户信息 临时先保存到session中
		$request->session()->put('user_info',$user);

		//返回数据
		$data = [
			'u_id'=>$user->u_id,
			'u_nickname'=>$user->u_nickname,
			'u_nickname'=>$user->u_nickname,
			'u_pic'=>$user->u_pic,

		];
		return $this->returnInfo($data,0,'登陆成功');
	}

	//删除授权(即退出)
	public function accessDelete(Request $request)
	{

	}
}