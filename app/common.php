<?php
// 应用公共文件
use think\facade\Cache;
use app\common\lib\Funnel;
if(!function_exists('success')) {
    /**
     * 操作成功
     * @param $data
     * @param string $msg
     * @param int $code
     * @return \think\response\Json
     * User: chenzhuo
     * Date: 2020/8/7 10:16 下午
     */
    function success($data, $msg = 'success', $code = 200)
    {
        return result($msg, $data, $code);
    }
}

if(!function_exists('error')) {
    /**
     * 操作失败
     * @param $data
     * @param string $msg
     * @param int $code
     * @return \think\response\Json
     * User: chenzhuo
     * Date: 2020/8/7 10:16 下午
     */
    function error($msg = 'error', $data=null, $code = 500)
    {
        return result($msg, $data, $code);
    }
}




if(!function_exists('result')) {
    /**
     * 通用化API输出
     * @param string $msg
     * @param array $data
     * @param int $code
     * @return \think\response\Json
     * User: chenzhuo
     * Date: 2020/8/7 10:13 下午
     */
    function result($msg = 'fail', $data = [], $code = 500)
    {
        $header = [];
        //处理跨域请求问题
        if (config('api.cross_domain.allow')) {
            $header = ['Access-Control-Allow-Origin' => '*'];
            if (request()->isOptions()) {
                $header = config('api.cross_domain.header');
                return json('',200,$header);
            }
        }
        return json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ], $code, $header);
    }
}


if(!function_exists('show')) {

    /**
     * 通用化API数据格式输出
     * @param $status
     * @param string $message
     * @param array $data
     * @param int $httpStatus
     * @return \think\response\Json
     */
    function show($status, $message = "error", $data = [], $httpStatus = 200)
    {

        $result = [
            "status" => $status,
            "message" => $message,
            "result" => $data
        ];

        return json($result, $httpStatus);
    }
}


if(!function_exists('isActionAllowed')) {
    function isActionAllowed($userId, $action, $period, $maxCount)
    {
        Cache::multi();
        $key = sprintf('hist:%s:%s', $userId, $action);
        $now = msectime();   # 毫秒时间戳
        Cache::zadd($key, $now, $now); //value 和 score 都使用毫秒时间戳
        Cache::zremrangebyscore($key, 0, $now - $period); //移除时间窗口之前的行为记录，剩下的都是时间窗口内的
        Cache::zcard($key);  //获取窗口内的行为数量
        Cache::expire($key, $period + 1);  //多加一秒过期时间
        $replies = Cache::exec();
        return $replies[2] <= $maxCount;
    }
}

if(!function_exists('msectime')) {


    function msectime() {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }

}


if(!function_exists('isActionAllowed2')) {

    function isActionAllowed2($userId, $action, $capacity, $leakingRate)
    {
        $key = sprintf("%s:%s", $userId, $action);
        $funnel = $GLOBALS['funnel'][$key] ?? '';
        if (!$funnel) {
            $funnel  = new Funnel($capacity, $leakingRate);
            $GLOBALS['funnel'][$key] = $funnel;
        }
        return $funnel->watering(1);
    }


}




