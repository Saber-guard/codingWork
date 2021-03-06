<?php
namespace App\Http\Validators\Home\System;

use App\Http\Validators\Validator;

class Mqtt extends Validator
{
	public $connectAccessGet = [
		'rule'=>[
			'client_id'=>'required',
			'username'=>'required',
			'password'=>'required',
		],
		'message'=>[
			// 'integer'=>'必须为数字',
		]
	];
	public $publishAccessGet = [
		'rule'=>[
			'client_id'=>'required',
			'username'=>'required',
			'topic'=>'required',
		],
		'message'=>[
		]
	];
	public $connectCallbackGet = [
		'rule'=>[
			'client_id'=>'required',
		],
		'message'=>[
		]
	];
	public $closeCallbackGet = [
		'rule'=>[
			'client_id'=>'required',
		],
		'message'=>[
		]
	];

}