<?php
namespace App\Http\Validators\Home\Cms;

use App\Http\Validators\Validator;

class Category extends Validator
{
	 public $categoryListGet = [
		'rule'=>[
			'page'=>'integer'
		],
		'message'=>[
		]
	];

}