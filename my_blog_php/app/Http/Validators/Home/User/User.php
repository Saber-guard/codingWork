<?php
namespace App\Http\Validators\Home\User;

use App\Http\Validators\Validator;

class User extends Validator
{
	 public $userPost = [
		'rule'=>[
			'u_account'=>'required|email|between:8,30',
			'u_pwd'=>'required|between:8,30',
		],
		'message'=>[
			'email'=>'邮箱格式不正确',
			'u_account.required'=>'邮箱不能为空',
			'u_pwd.required'=>'密码不能为空',
			'u_account.between'=>'邮箱长度不符',
			'u_pwd.between'=>'密码长度不符',
		]
	];

	 public $accessPost = [
		'rule'=>[
			'account'=>'required|between:8,30',
			'pwd'=>'required|between:8,30',
		],
		'message'=>[
			'account.required'=>'邮箱不能为空',
			'pwd.required'=>'密码不能为空',
			'account.between'=>'邮箱长度不符',
			'pwd.between'=>'密码长度不符',
		]
	];

}