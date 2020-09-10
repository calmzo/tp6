<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 04:19
 */

namespace app\common\lib;
class Key {

    /**
     * userCart 记录用户购物车的redis key
     * @param $userId
     * @return string
     */
    public static function userCart($userId) {
        return config("redis.cart_pre") . $userId;
    }
}