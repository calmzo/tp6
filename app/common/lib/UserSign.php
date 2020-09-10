<?php
/**
 * UserSign.php
 * User chenzhuo
 * Date 2020/8/25 2:21 下午
 * Description :
 */
namespace app\common\lib;

use think\facade\Cache;
class UserSign
{


    /**
     * 用户签到
     * @param $uid 用户id
     * @return bool 之前的签到状态
     * User: chenzhuo
     * Date: 2020/8/25 2:50 下午
     */
    public function doSign($uid ,$time = 0){
        $time = $time ? $time : time();
        $key = self::buildKey($uid);
        $offset = date("d", $time)-1;
        Cache::setBit($key,$offset,1); //当天签到
        return true;
    }


    /**
     * 检查用户是否签到
     * @param $uid 用户id
     * @param int $time 日期
     * @return mixed 当前的签到状态
     * User: chenzhuo
     * Date: 2020/8/25 2:50 下午
     */
    public function checkSign($uid, $time = 0){
        $time = $time ? $time : time();
        $offset = date("d", $time)-1;
        $key = self::buildKey($uid, $time);
        $res = Cache::getBit($key, $offset);
        return $res;
    }

    /**
     * 获取用户签到次数
     * @param $uid 用户id
     * @param int $time 日期
     * @return mixed 当前的签到次数
     * User: chenzhuo
     * Date: 2020/8/25 2:54 下午
     */
    public function getSignCount($uid, $time = 0){
        $time = $time ? $time : time();
        $key = self::buildKey($uid, $time);
        $res = Cache::bitCount($key);
        return $res;
    }





    /**
     * 获取当月首次签到日期
     * @param int $uid 用户id
     * @param int $time 日期
     * @return int|null 首次签到日期
     * User: chenzhuo
     * Date: 2020/8/25 3:04 下午
     */
    public function getFirstSignDate(int $uid, $time = 0){
        $time = $time ? $time : time();
        $key = self::buildKey($uid, $time);
        $pos = Cache::bitPos($key, true);
        $day = $pos+1;
        return $pos < 0 ? null : date("Y-m-",$time).$day;
    }





    /**
     * 获取当月连续签到次数  todo
     * @param int $uid
     * @param int $time
     * @return int
     * User: chenzhuo
     * Date: 2020/8/25 3:23 下午
     */
    public function getContinuousSignCount(int $uid, $time = 0){
        //Cache::bitfield()  todo..

        return 0;
    }

    /**
     * 获取当月签到情况
     * @param int $uid
     * @param int $time
     * User: chenzhuo
     * Date: 2020/8/25 3:21 下午
     */
    public function getSignInfo(int $uid, $time = 0){

        //Cache::bitfield()  todo..

        return [];
    }



    protected function buildKey(int $uid, $time = 0){
        $time = $time ? $time : time();
        $month = date("Y-m", $time);
        return 'u_sign_'.$uid.$month;
    }



}