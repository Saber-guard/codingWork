<?php
namespace App\Http\Controllers\Home\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Upload extends Controller
{
	//获取oss的上传签名
	public function uploadSigGet(Request $request)
	{
		$param = $this->param;

	    $id= env('OSS_ACCESSKEYID','');
	    $key= env('OSS_ACCESSKEYSECRET','');
	    $host = env('OSS_DOMAIN','');

	    $now = time();
	    $expire = 60; //设置该policy超时时间是10s. 即这个policy过了这个有效时间，将不能访问
	    $end = $now + $expire;
	    $expiration = $this->gmt_iso8601($end);

	    //最大文件大小.用户可以自己设置
	    $condition = array(0=>'content-length-range', 1=>0, 2=>1048576000);
	    $conditions[] = $condition;

	    $arr = array('expiration'=>$expiration,'conditions'=>$conditions);
	    //echo json_encode($arr);
	    //return;
	    $policy = json_encode($arr);
	    $base64_policy = base64_encode($policy);
	    $string_to_sign = $base64_policy;
	    $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $key, true));

	    $response = array();
	    $response['OSSAccessKeyId'] = $id;
	    $response['host'] = $host;
	    $response['policy'] = $base64_policy;
	    $response['signature'] = $signature;
	    $response['expire'] = $end;

		//返回
		return $this->returnInfo($response,0,'成功');
	}




//===================================================================================================================

	//获得oss需要的时间格式
	private function gmt_iso8601($time) {
        $dtStr = date("c", $time);
        $mydatetime = new \DateTime($dtStr);
        $expiration = $mydatetime->format(\DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration."Z";
    }
}