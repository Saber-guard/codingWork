<?php
namespace App\Http\Validators\Home\System;

use App\Http\Validators\Validator;

class File extends Validator
{
	 public $fileUrlGet = [
		'rule'=>[
			'path'=>'required',
		],
		'message'=>[
			// 'integer'=>'必须为数字',
		]
	];

}