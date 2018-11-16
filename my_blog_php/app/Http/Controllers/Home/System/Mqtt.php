<?php
namespace App\Http\Controllers\Home\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientRecord as C;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cookie;
use App\Libs\mqtt\phpMQTT;

class Mqtt extends Controller
{
    //发布客户端id的前缀
    public $publish_pre = "codingwork_publish";
    //公共发布频道
    public $public_publish_list = [

    ];
    //公共订阅频道
    public $public_subscribe_list = [
        '/public/online',
    ];

    //新增mqtt连接授权clientID
    public function mqttClientIdPost(Request $request,C $clientRecord)
    {
        $param = $this->param;

        $client_agent = $_SERVER['HTTP_USER_AGENT'];
        $client_ip =  $this->getRemoteAddr();
        $time = time();
        //根据访客信息生成对应的client_pre
        $client_pre = $this->getClientPre();

        $record = $clientRecord->where('cr_client_pre','=',$client_pre)->first();
        if (empty($record)) {
            $data['cr_ip'] = $client_ip;
            $data['cr_client_pre'] = $client_pre;
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
            'clientid'=>$client_pre.':'.$time,
            'user'=>$client_pre,
        );

        //设置cookie
        session(['client_id' => $response['clientid']]);
        session()->save();

        //返回
        return $this->returnInfo($response,0,'成功');
    }

    //获取连接授权
    public function connectAccessGet(Request $request,C $clientRecord)
    {
        $param = $this->param;
        $ext = 'codingwork';
        $msg = 'err';

        //检查 client_id username password
        $client_pre = explode(':', $param['client_id'])[0];
        //发布客户端
        if ($client_pre == $this->publish_pre) {
            $msg = 'username err';
            if ($param['username'] == md5($param['client_id'])) {
                $msg = 'pwd err';
                if ($param['password'] == md5($param['client_id'])) {
                    $msg = 'succ';
                }
            }
        }
        //普通客户端
        else {
            $msg = 'clientID err';
            $record = $clientRecord->where('cr_client_pre','=',$client_pre)->first();
            if (!empty($record)) {
                $msg = 'username err';
                if ($client_pre == $param['username']) {
                    $msg = 'pwd err';
                    if ($param['password'] == md5($param['username'].$ext)) {
                        $msg = 'succ';
                    }
                }
            }
        }

        if ($msg == 'succ') {
            $errno = 0;
            //初始化可订阅列表

            //初始化可发布列表

        } else {
            $errno =  2 ;
        }


        return $this->returnInfo([],$errno,$msg);

    }

    //获取订阅授权
    public function subscribeAccessGet(Request $request)
    {
        $param = $this->param;
        $msg = 'forbiden';

        //公共订阅频道
        if (in_array( $param['topic'],$this->public_subscribe_list)) {
            $msg = 'succ';
        }

        //判断是否连接
        if ($this->hasClientIdConnect($param['client_id'])) {
            //管理后台
            $perfix = '/^codingwork_admin:(\d)+_(\d){10}/';
            if (preg_match($perfix, $param['client_id'])) {
                $msg = 'succ';
            }

            //client_id专属频道
            $perfix = '/^\/personal\/'.$param['client_id'].'$/';
            if (preg_match($perfix, $param['topic'])) {
                $msg = 'succ';
            }

            //client_username专属频道
            $perfix = '/^\/personal\/'.$param['username'].'$/';
            if (preg_match($perfix, $param['topic'])) {
                $msg = 'succ';
            }
        }

        $errno = $msg == 'succ' ? 0 : 2 ;
        return $this->returnInfo([],$errno,$msg);
    }

    //获取发布授权
    public function publishAccessGet(Request $request)
    {
        $param = $this->param;
        $msg = 'forbiden';

        //公共发布频道
        if (in_array( $param['topic'],$this->public_publish_list)) {
            $msg = 'succ';
        }

        //发布客户端
        $perfix = '/^'.$this->publish_pre.':(\d)+/';
        if (preg_match($perfix, $param['client_id'])) {
            $msg = 'succ';
        }

        //其他先判断是否连接
        if ($this->hasClientIdConnect($param['client_id'])) {
            //管理后台
            $perfix = '/^codingwork_admin:(\d)+_(\d){10}/';
            if (preg_match($perfix, $param['client_id'])) {
                $msg = 'succ';
            }

            //client_id专属频道
            $perfix = '/^\/personal\/'.$param['client_id'].'$/';
            if (preg_match($perfix, $param['topic'])) {
                $msg = 'succ';
            }

            //client_username专属频道
            $perfix = '/^\/personal\/'.$param['username'].'$/';
            if (preg_match($perfix, $param['topic'])) {
                $msg = 'succ';
            }
        }

        $errno = $msg == 'succ' ? 0 : 2 ;
        return $this->returnInfo([],$errno,$msg);
    }

    //获取当前客户端连接数目
    public function clientCountGet()
    {
        $param = $this->param;
        $count = Redis::hlen('mqtt:clients');

        return $this->returnInfo(['count'=>$count],0);
    }


//=======================================================================================================================================
    //根据访客信息生成对应的client_pre
    public function getClientPre()
    {
        $client_agent = $_SERVER['HTTP_USER_AGENT'];
        $client_ip =  $this->getRemoteAddr();
        return sha1($client_ip.$client_agent);
    }

    //判断一个client_id当前是否连接
    public function hasClientIdConnect($client_id)
    {
        $client = Redis::hget('mqtt:clients',$client_id);
        return empty($client)?false:true;
    }

    //判断一个client_pre当前是否有连接
    public function hasClientPreConnect($client_pre)
    {
        $keys = Redis::hkeys('mqtt:clients');
        foreach ($keys as $key) {
            if (strpos($key,$client_pre.':') === 0) {
                return true;
            }
        }

        return false;
    }

    //连接
    public function connect()
    {
        $server = env('MQTT_DOMAIN');
        $port = env('MQTT_PORT');
        $client_id = $this->publish_pre. ":". time() .mt_rand(10000,99999);
        $username = md5($client_id);
        $password = md5($client_id);
        $php_mqtt = new phpMQTT($server, $port, $client_id);
        $php_mqtt->connect(true, NULL, $username, $password);
        return $php_mqtt;
    }

}