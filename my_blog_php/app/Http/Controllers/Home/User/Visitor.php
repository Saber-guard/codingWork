<?php
namespace App\Http\Controllers\Home\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor as V;

class Visitor extends Controller
{
	public function visitorNumGet(V $visitor)
	{
		$num = $visitor->count();
		return $this->returnInfo(['num'=>$num?$num:0],0);
	}
}