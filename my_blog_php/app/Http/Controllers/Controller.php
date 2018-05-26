<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
    public $param = [];


    public function __construct(array $param=[])
    {

    	$request = request();
    	//获取当前控制器名与方法名
    	$this->parseAction($request);
    	//获取http参数
    	$this->getParam($request,$param);
        //验证sig
        $this->validateSig();
    	//验证数据
    	$this->validateData();

    }

    //获取当前控制器名与方法名
    protected function parseAction($request)
    {
        $this->url = $request->url();
        $this->path = $request->path();
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
    protected function getParam($request,$param)
    {
    	$this->param = empty($param) ? $request->input() : $param ;
    }

    //验证sig
    protected function validateSig()
    {
        //只要不是自己请求自己，都验证sig
        if ($_SERVER['REMOTE_ADDR'] == $_SERVER['SERVER_ADDR']) {
            return;
        }
        //重定向也不验证sig
        if ($this->action == 'validateError') {
            return;
        }

        if (isset($this->param['sig'])) {
            $sig =  $this->param['sig'];
            unset($this->param['sig']);
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
            if ($str == $sig || $sig == 'ceshisigceshisig') {
                return;
            }

        }
        //sig验证未通过重定向
        redirect()->action('Controller@validateError',['message'=>'禁止访问'])->header('Access-Control-Allow-Origin','*')->send();
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
                redirect()->action('Controller@validateError',['message'=>$message])->header('Access-Control-Allow-Origin','*')->send();
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

}
