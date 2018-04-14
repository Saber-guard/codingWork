<?php
namespace App\Http\Middleware;

use Closure;
use Response;

//允许跨域请求中间件
class CrossRequestMiddleware
{
public function handle($request, Closure $next)
	{

		$response = $next($request);
		    $response->header('Access-Control-Allow-Origin', config('app.allow'));
		    $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
		    $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
		    $response->header('Access-Control-Allow-Credentials', 'true');
		    return $response;
	}
}