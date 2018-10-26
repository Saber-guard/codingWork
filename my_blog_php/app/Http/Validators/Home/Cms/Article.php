<?php
namespace App\Http\Validators\Home\Cms;

use App\Http\Validators\Validator;

class Article extends Validator
{
	public $articleListGet = [
		'rule'=>[
			'id'=>'sometimes|required|integer',
			'u_id'=>'sometimes|required|integer',
			'c_id'=>'sometimes|required|integer',
			'page'=>'sometimes|required|integer',
		],
		'message'=>[
			'integer'=>'必须为数字'
		]
	];

	public $articleGet = [
		'rule'=>[
			'id'=>'required|integer'
		],
		'message'=>[
			'integer'=>'必须为数字'
		]
	];

	public $articlePut = [
		'rule'=>[
			'a_pic'=>'url',
		],
		'message'=>[

		]
	];

	public $articlePost = [
		'rule'=>[
			'a_c_id'=>'required|integer',
			'a_title'=>'required|string|between:1,50',
			'a_text'=>'required|string|between:1,20000',
			'a_describe'=>'required|string|between:1,200',
		],
		'message'=>[

		]
	];

}