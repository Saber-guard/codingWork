<?php
namespace App\Http\Validators\Home\System;

use App\Http\Validators\Validator;

class Upload extends Validator
{
	 public $uploadSigGet = [
		'rule'=>[
			// 'type'=>'required|integer',
		],
		'message'=>[
			// 'integer'=>'必须为数字',
		]
	];

}