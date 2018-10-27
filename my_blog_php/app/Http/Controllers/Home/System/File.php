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

		//无client连接都返回同一张图片
		$mqtt = new Mqtt([]);
		$client_pre = $mqtt->getClientPre();
		if ($mqtt->hasClientPreConnect($client_pre)) {
			$param['path'] = 'http://api.codingwork.cn/system/file?data={"path":"pic/5964473d4e8151.jpg"}';
		}

	    $id= env('OSS_ACCESSKEYID','');
	    $key= env('OSS_ACCESSKEYSECRET','');
	    $endpoint = env('OSS_ENDPOINT','');

	    $ossClient = new OssClient($id, $key, $endpoint);
	    $url = $ossClient->signUrl($this->bucket, $param['path'] , 600);

	    //跳转到图片链接
	    redirect($url)->send();

	}


//=================================================================================================================

}