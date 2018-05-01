<?php
namespace App\Http\Validators\Home\Cms;

use App\Http\Validators\Validator;

class Category extends Validator
{
	 public $categoryListGet = [
		'rule'=>[
			'parent'=>'integer',
			'page'=>'integer',
		],
		'message'=>[
		]
	];

}