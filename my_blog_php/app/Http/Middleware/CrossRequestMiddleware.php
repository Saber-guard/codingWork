<?php
namespace App\Http\Middleware;

use Closure;
use Response;

//允许跨域请求中间件
class CrossRequestMiddleware
{
public function handle($request, Closure $next)
	{
		$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

		$allow_origin = array(
		    'http://localhost:8080',
		    'http://codingwork.com:8080',
		    'http://codingwork.com',
		    'http://codingwork.cn',
		    'http://yunyun.codingwork.cn',
		    'http://yunyun.codingwork.com',
		);

		$response = $next($request);
		if (in_array($origin,$allow_origin)) {
		    $response->header('Access-Control-Allow-Origin', $origin);
		    $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
		    $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
		    $response->header('Access-Control-Allow-Credentials', 'true');
		}

	    return $response;
	}
}