<?php
// 应用公共文件
if(!function_exists('success')){
    /**
     * 操作成功
     * @param string $msg
     * @param string $data
     * @param int $code
     * @return Json
     */
    function success($data = '', $msg = 'success', $code = 200)
    {
        return result($msg, $data, $code);
    }
}

if(!function_exists('error')){
    /**
     * 操作失败
     * @param string $msg
     * @param string $data
     * @param int $code
     * @return Json
     */
    function error($msg = 'fail', $data = '', $code = 500)
    {
        return result($msg, $data, $code);
    }
}

if(!function_exists('result')){
    /**
     * 返回json结果
     * @param string $msg
     * @param string $data
     * @param int $code
     * @return Json
     */
    function result($msg = 'fail', $data = '', $code = 500)
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
            'msg'  => $msg,
            'data' => $data,
        ], $code, $header);
    }

}