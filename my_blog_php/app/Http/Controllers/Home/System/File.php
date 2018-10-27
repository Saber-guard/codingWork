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
	// public function fileUrlGet(Request $request)
	// {
	// 	$param = $this->param;

	//     $id= env('OSS_ACCESSKEYID','');
	//     $key= env('OSS_ACCESSKEYSECRET','');
	//     $endpoint = env('OSS_ENDPOINT','');

	//     $ossClient = new OssClient($id, $key, $endpoint);

	//     $url = $ossClient->signUrl($this->bucket, $param['path'] , 600);

	// 	//返回
	// 	return $this->returnInfo(['url'=>$url],0,'成功');
	// }

	//访问文件接口
	public function fileGet(Request $request)
	{
		$param = $this->param;

		//判断有无client连接
		$mqtt = new Mqtt([]);
		$client_pre = $mqtt->getClientPre();
		if ($mqtt->hasClientPreConnect($client_pre)) {

		    $id= env('OSS_ACCESSKEYID','');
		    $key= env('OSS_ACCESSKEYSECRET','');
		    $endpoint = env('OSS_ENDPOINT','');

		    $ossClient = new OssClient($id, $key, $endpoint);
		    $url = $ossClient->signUrl($this->bucket, $param['path'] , 600);

		    //跳转到图片链接
		    redirect($url)->send();
		}

		return $this->returnInfo([],2,'无权访问');
	}


//=================================================================================================================

}