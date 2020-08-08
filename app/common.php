<?php
// 应用公共文件

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