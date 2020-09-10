<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 23:41
 */
declare(strict_types=1);
namespace app\common\service;
use app\common\lib\sms\AliSms;
use app\common\lib\Num;
use app\common\lib\ClassArr;
class Sms {
    public static function sendCode(string $phoneNumber, int $len, string $type = "ali") :bool{

        // 我们需要生成我们短信验证码 4位  6位
        $code = Num::getCode($len);
        //$sms = AliSms::sendCode($phoneNumber, $code);

        // 工厂模式
//        $type = ucfirst($type);
//        $class = "app\common\lib\sms\\".$type."Sms";
//        $sms = $class::sendCode($phoneNumber, $code);

        $classStats = ClassArr::smsClassStat();
        $classObj = ClassArr::initClass($type, $classStats);
        $sms = $classObj::sendCode($phoneNumber, $code);
        if($sms) {
            // 需要把我们得短信验证码记录到redis 并且需要给出一个失效时间 1分钟
            // 1 、我们得PHP环境是否有 redis扩展 redis.dll  linux unix：redis.so
            // 2 redis服务
            cache(config("redis.code_pre").$phoneNumber, $code, config("redis.code_expire"));
        }

        return $sms;
    }
}