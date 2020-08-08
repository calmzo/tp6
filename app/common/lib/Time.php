<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 11:52
 */

namespace app\common\lib;

class Time {
    public static function userLoginExpiresTime($type = 2) {
        $type = !in_array($type, [1, 2]) ? 2 : $type;
        if($type == 1) {
            $day = 7;
        } elseif ($type == 2) {
            $day = 30;
        }
        return $day * 24 * 3600;
    }
}