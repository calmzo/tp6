<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 17:03
 */
namespace app\common\lib;
class Status {
    public static function getTableStatus() {
        $mysqlStatus = config("status.mysql");
        return array_values($mysqlStatus);
    }
}