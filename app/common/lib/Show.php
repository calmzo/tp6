<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 01:27
 */
namespace app\common\lib;

class Show {
    /**
     * @param array $data
     * @param string $message
     * @return \think\response\Json
     */
    public static function success($data = [], $message = "OK") {
        $result = [
            "status" => config("status.success"),
            "message" => $message,
            "result" => $data
        ];

        return json($result);
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $status
     * @return \think\response\Json
     */
    public static function error($message = "error", $status = 0, $data = []) {
        $result = [
            "status" => $status,
            "message" => $message,
            "result" => $data
        ];

        return json($result);
    }
}