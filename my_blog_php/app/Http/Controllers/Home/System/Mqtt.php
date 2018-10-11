<?php
namespace App\Http\Controllers\Home\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientRecord as C;

class Mqtt extends Controller
{
    //获取clientID
    public function mqttClientIdGet(Request $request,C $clientRecord)
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
        );

        //返回
        return $this->returnInfo($response,0,'成功');
    }

    //获取连接授权
    public function connectAccessGet()
    {
        
    }

}