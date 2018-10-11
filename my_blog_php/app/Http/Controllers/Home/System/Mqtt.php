<?php
namespace App\Http\Controllers\Home\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientRecord as C;

class Mqtt extends Controller
{
    //新增mqtt连接授权clientID
    public function mqttClientIdPost(Request $request,C $clientRecord)
    {
        $param = $this->param;

        $client_agent = $_SERVER['HTTP_USER_AGENT'];
        $client_ip =  $_SERVER['REMOTE_ADDR'];
        $time = time();
        $clientid = sha1($client_ip.$client_agent);

        $record = $clientRecord->where('cr_client_id','=',$clientid)->first();
        if (empty($record)) {
            $data['cr_ip'] = $client_ip;
            $data['cr_client_id'] = $clientid;
            $data['cr_user_agent'] = $client_agent;
            $data['cr_datetime'] = date('Y-m-d H:i:s',$time);
            //新增数据
            $id = $clientRecord->insertGetId($data);
            if (empty($id)) {
                //
                return $this->returnInfo(array(),2,'初始化失败');
            }
        }

        $response = array(
            'ip'=>$client_ip,
            'useragent'=>$client_agent,
            'clientid'=>$clientid.':'.$time,
            'user'=>$clientid,
        );

        //返回
        return $this->returnInfo($response,0,'成功');
    }

    //获取连接授权
    public function connectAccessGet(Request $request,C $clientRecord)
    {
        $param = $this->param;
        $ext = 'codingwork';
        $msg = 'clientID err';

        //检查 client_id username password
        $client_id = explode(':', $param['client_id'])[0];
        $record = $clientRecord->where('cr_client_id','=',$client_id)->first();
        if (!empty($record)) {
            $msg = 'username err';
            if ($client_id == $param['username']) {
                $msg = 'pwd err';
                if ($param['password'] == md5($param['username'].$ext)) {
                    $msg = 'succ';
                }
            }
        }

        $errno = $msg == 'succ' ? 0 : 1 ;
        return $this->returnInfo([],$errno,$msg);

    }

}