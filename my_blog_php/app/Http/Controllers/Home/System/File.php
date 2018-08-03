<?php
namespace App\Http\Controllers\Home\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OSS\OssClient;
use OSS\Core\OssException;

class File extends Controller
{
	public $bucket = 'codingwork';

	//获取oss的文件访问路径
	public function fileUrlGet(Request $request)
	{
		$param = $this->param;

	    $id= env('OSS_ACCESSKEYID','');
	    $key= env('OSS_ACCESSKEYSECRET','');
	    $endpoint = env('OSS_ENDPOINT','');

	    $ossClient = new OssClient($id, $key, $endpoint);

	    $url = $ossClient->signUrl($this->bucket, $param['path'] , 600);

		//返回
		return $this->returnInfo(['url'=>$url],0,'成功');
	}


}