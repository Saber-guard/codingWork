<?php
namespace App\Http\Controllers\Home\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OSS\OssClient;
use OSS\Core\OssException;

class File extends Controller
{
	public $bucket = 'codingwork';

	//访问文件接口
	public function fileGet(Request $request)
	{
		$param = $this->param;

		//从session中获取client_id,并判断连接是否还在
		$session_client_id = session('client_id');
		$mqtt = new Mqtt([]);
		if (!empty($session_client_id) && $mqtt->hasClientIdConnect($session_client_id)) {

		    $id= env('OSS_ACCESSKEYID','');
		    $key= env('OSS_ACCESSKEYSECRET','');
		    $endpoint = env('OSS_ENDPOINT','');

		    $ossClient = new OssClient($id, $key, $endpoint);
		    $url = $ossClient->signUrl($this->bucket, $param['path'] , 600);

		    //跳转到图片链接
		    return redirect($url)->send();
		} else {
			return $this->returnInfo([],2,'fail');
		}

	}


//=================================================================================================================

}