<?php
/**
 * check.php
 * User chenzhuo
 * Date 2020/8/8 9:07 上午
 * Description :
 */
namespace app\api\middleware;
use think\Response;
class check
{

    public function handle($request, \Closure $next) {
        $request->type = 'calm';
        return $next($request);
    }


    public function end(Response $response)
    {


    }

}