<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Visitor;
use OSS\OssClient;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //专属验证器
    public $validator = null;
    //当前控制器
    public $controller = null;
    //当前方法
    public $action = null;
    //当前url
    public $url = '';
    //当前path
    public $path = '';

    //http请求参数
    public $param;
    public $sig;

    //不用验证sig的path列表
    public $no_sig_path_list = [
        '/system/file',
    ];


    public function __construct(array $requestData=[])
    {

    	$request = request();
    	//获取当前控制器名与方法名
    	$this->parseAction($request);

    	//获取http参数
    	$this->getParam($request,$requestData);
        //验证sig
        $this->validateSig();
    	//验证数据
    	$this->validateData();

    }

    //获取当前控制器名与方法名
    protected function parseAction($request)
    {
        $this->url = $request->url();
        $this->path = '/'. ltrim($request->path(),'/');
    	$path = $request->route()->getActionName();
    	$times = 1;
    	$tmp = str_replace('Controllers','Validators',$path,$times);
    	//验证器
    	$this->validator = explode('@',$tmp)[0];
    	//方法名
    	$this->action = explode('@',$tmp)[1];
    	//控制器名
    	$tmp = explode('\\',$this->validator);
    	$this->controller = array_pop($tmp);

    }

    //获取http参数
    protected function getParam($request,$requestData)
    {
        $requestData = empty($requestData) ? $request->input() : $requestData ;

        //获取sig
        $this->sig = isset($requestData['sig'])?$requestData['sig']:'';
        //获取请求参数
        $this->param = isset($requestData['data'])
                        && json_decode($requestData['data'],true) ?
                        json_decode($requestData['data'],true):[];

    }

    //验证sig
    protected function validateSig()
    {
        //重定向不验证
        if ($this->action == 'validateError') {
            return;
        }
        //特殊sig不验证
        if ($this->sig == 'ceshisigceshisig') {
            return;
        }
        //指定path不验证
        if (in_array($this->path,$this->no_sig_path_list)) {
            return;
        }

        if ($this->sig) {
            $sig =  $this->sig;
            $param = $this->param;
            //排序
            ksort($param);
            //拼接
            $str = $this->path;
            foreach ($param as $key => $value) {
                $value = is_array($value)? json_encode($value): $value;
                $str .= $key. '='. $value;
            }
            //加密
            $str = md5($str);
            $str = substr($str,1,25);
            if ($str == $sig) {
                return;
            }
        }
        //sig验证未通过重定向
        $this->redirect('Controller@validateError','禁止访问');
        exit;
    }

    //验证数据
    protected function validateData()
    {
    	//验证器与相应的验证方法是否存在
    	if (class_exists($this->validator) &&
    		property_exists($this->validator,$this->action)) {

    		//若存在，则获取验证规则进行验证
    		$action = $this->action;
    		//1.new出验证器
    		$validator = new $this->validator();
    		//2.取出验证参数
    		$validate_param = is_array($validator->$action) ?
    			$validator->$action : ['rule'=>[],'message'=>[]] ;
    		$rule = isset($validate_param['rule']) && is_array($validate_param['rule']) ?
    			$validate_param['rule'] : [] ;
    		$message = isset($validate_param['message']) && is_array($validate_param['message']) ?
    			$validate_param['message'] : [] ;
    		//验证
            $validator = Validator::make($this->param,$rule,$message);
            if ($validator->fails()) {
                $message = '参数错误';
                //调试模式下返回具体错误信息
                if (config('app.debug')) {
                    $errors = $validator->errors();
                    foreach ($errors->toArray() as $key => $value) {
                        if ($errors->first($key)) {
                            $message = $errors->first($key);
                            break;
                        }
                    }
                }

                //参数错误重定向
                $this->redirect('Controller@validateError',$message);
                exit;
            }
    	}
    }

    //返回接口数据
    protected function returnInfo($data=[],$errno=0,$info=null)
    {
    	//没有指定errno时
		if ($errno !== 0) {
			$errno = (int)$errno;
		}

		//默认提示信息列表
		$infoList = [
			'0'=>'success',
			'1'=>'参数不全或错误',
			'2'=>'操作失败',
		];
		//错误信息
		if (array_key_exists($errno,$infoList)) {
			$info = $info===null ? $infoList[$errno]: $info ;
		} else {
			$info = $info===null ? '未知错误': $info ;
		}
		if (empty($data)) { $data = (object)array(); }

        //获取oss的文件访问路径
        // $data = $this->getAllOssFile($data);

		$this->data = [
			'errno'=>$errno,
			'info'=>$info,
			'data'=>$data
		];
        return response()->json($this->data);
    }


    //参数错误重定向
    public function validateError()
    {
        $info = $this->param['message'];
        return $this->returnInfo([],1,$info);
    }

    protected function redirect($action,$message)
    {
        $data = [
            'data'=>json_encode(['message'=>$message]),
        ];
        redirect()  ->action($action,$data)
                    ->header('Access-Control-Allow-Origin','*')
                    // ->header('Content-type','application/json')
                    ->send();
    }

    protected function getAllOssFile($data) {
        if (!($data instanceof \stdClass) && is_object($data)) {
            $data = $data->toArray($data);
        }

        $domain = env('OSS_DOMAIN','');
        $id= env('OSS_ACCESSKEYID','');
        $key= env('OSS_ACCESSKEYSECRET','');
        $endpoint = env('OSS_ENDPOINT','');
        $bucket = 'codingwork';
        $ossClient = new OssClient($id, $key, $endpoint);

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->getAllOssFile($value);
            } else if (is_string($value)) {
                if (strpos($value,$domain. '/') !== false && strpos($value,'OSSAccessKeyId') === false) {
                    $data[$key] = str_replace($domain. '/','',$data[$key]);
                    $data[$key] = $ossClient->signUrl($bucket, $data[$key] , 600);
                }
            }
        }

        return $data;
    }

}
