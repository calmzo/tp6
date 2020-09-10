<?php
/**
 * index.php
 * User chenzhuo
 * Date 2020/8/19 8:57 上午
 * Description :
 */
namespace app\index\controller;
use AlibabaCloud\Client\Config\Config;
use app\BaseController;
use app\common\lib\GeoHash;
use app\common\lib\import\UserImport;
use app\common\lib\nosql\Mongodb;
use app\common\lib\RedisLock;
use app\common\lib\UserSign;
use app\common\model\mongo\Test;
use app\common\model\mysql;
use app\common\model\mongo\User;
use app\Http\Exception\ApiException;
use think\App;
use think\facade\Db;
use think\facade\Cache;
use think\facade\View;
use app\common\lib\nosql\SRedis;
use app\common\lib\ClassArr;
class index extends BaseController
{



    public function index(){


//        Cache::set("calm2",'calm2');
//        print_r(Cache::get("calm2"));die;
//        $geohash = new GeoHash();
//        $res = $geohash->geoAdd('calmgeo1', '108.945315', '34.380882');
//        $res = $geohash->geodist(1,2);
//        $res = $geohash->getGeo('calmgeo1');
//          $res = $geohash->geoRadius('1',50000, 'km',10);
//        halt($res);


//        for ($i = 0; $i<1000; $i++){
//            Cache::set('calm'.$i, $i);
//        }
//        halt(Cache::keys('calm10*'));











//        for ($i=0; $i<20; $i++) {
//
//            $res = isActionAllowed2('100', 'reply', 60 * 1000, 5);
//            var_dump($res);
//        }





//        for ($i=0; $i<10000; $i++){
//
//            Cache::pfAdd('loginCount',[$i]);
//
//        }
//        echo Cache::pfCount('loginCount');die;




//        $uid = 1;
//        $userSign= new UserSign();
//        $res = $userSign->doSign($uid, 1598198400);
//        $res = $userSign->checkSign($uid,1598198400);
//        $res = $userSign->getSignCount($uid, 1590940800);
//        $res = $userSign->getFirstSignDate($uid);
//        print_r($res);






//        $uid = 100;
//        $date = date("Y-m");
//        $day = date('d')-1;
//        $key = 'u_sign_'.$uid.$date;

//        Cache::setBit($key,$day,1); //当天签到
//        $res = Cache::getBit($key, $day); //当天是否签到
//        $res = Cache::bitCount($key); //当月签到次数
//        $res = Cache::bitCount('u_sign_'.$uid.date("Y").'-01'); //某月签到次数


//        print_r($res);die;




//        $res = '<form id=\'alipaysubmit\' name=\'alipaysubmit\' action=\'https://openapi.alipaydev.com/gateway.do?charset=UTF-8\' method=\'POST\'><input type=\'hidden\' name=\'biz_content\' value=\'{"product_code":"FAST_INSTANT_TRADE_PAY","body":"支付","subject":"保证书","total_amount":"1.00","out_trade_no":"1293887461726633984"}\'/><input type=\'hidden\' name=\'app_id\' value=\'2021000119683471\'/><input type=\'hidden\' name=\'version\' value=\'1.0\'/><input type=\'hidden\' name=\'format\' value=\'json\'/><input type=\'hidden\' name=\'sign_type\' value=\'RSA2\'/><input type=\'hidden\' name=\'method\' value=\'alipay.trade.page.pay\'/><input type=\'hidden\' name=\'timestamp\' value=\'2020-08-24 20:16:34\'/><input type=\'hidden\' name=\'alipay_sdk\' value=\'alipay-sdk-php-20161101\'/><input type=\'hidden\' name=\'notify_url\' value=\'http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php\'/><input type=\'hidden\' name=\'return_url\' value=\'http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/return_url.php\'/><input type=\'hidden\' name=\'charset\' value=\'UTF-8\'/><input type=\'hidden\' name=\'sign\' value=\'RiKpYy40Psh2WELOiUngrK1ByS290pCAmcvh6xOJz/R2UcGp5rdb2FCmnJXPoqFREu3Br8rT/jDClLnJ8PSA8ff3muR9lI+GdJWVNHz1acwFl/OX+V+agjR9v6X430847I2QLvuhmUlVrE0p7l8yiU81Dh2rREYtTtgjMzqtJFpuAZf8l6m03lvqBddk0ED/kO2y5HTspF3yCiWizpDaVZEfAR7ziPqZWUjUTfC1iinLAQG9FMriineOjI5c2VyPRVf0v8QI3w3gVDVNlaC0iXFsrrvS2eeRvrZ/zn083CXlDMYnLV42smz2rZOIoix7/u7DDXiVmx65xlUw9djY5g==\'/><input type=\'submit\' value=\'ok\' style=\'display:none;\'\'></form><script>document.forms[\'alipaysubmit\'].submit();</script>{"msg":"success","status":200,"data":"\"<form id=\'alipaysubmit\' name=\'alipaysubmit\' action=\'https:\\\/\\\/openapi.alipaydev.com\\\/gateway.do?charset=UTF-8\' method=\'POST\'><input type=\'hidden\' name=\'biz_content\' value=\'{\\\"product_code\\\":\\\"FAST_INSTANT_TRADE_PAY\\\",\\\"body\\\":\\\"支付\\\",\\\"subject\\\":\\\"保证书\\\",\\\"total_amount\\\":\\\"1.00\\\",\\\"out_trade_no\\\":\\\"1293887461726633984\\\"}\'\\\/><input type=\'hidden\' name=\'app_id\' value=\'2021000119683471\'\\\/><input type=\'hidden\' name=\'version\' value=\'1.0\'\\\/><input type=\'hidden\' name=\'format\' value=\'json\'\\\/><input type=\'hidden\' name=\'sign_type\' value=\'RSA2\'\\\/><input type=\'hidden\' name=\'method\' value=\'alipay.trade.page.pay\'\\\/><input type=\'hidden\' name=\'timestamp\' value=\'2020-08-24 20:16:34\'\\\/><input type=\'hidden\' name=\'alipay_sdk\' value=\'alipay-sdk-php-20161101\'\\\/><input type=\'hidden\' name=\'notify_url\' value=\'http:\\\/\\\/外网可访问网关地址\\\/alipay.trade.page.pay-PHP-UTF-8\\\/notify_url.php\'\\\/><input type=\'hidden\' name=\'return_url\' value=\'http:\\\/\\\/外网可访问网关地址\\\/alipay.trade.page.pay-PHP-UTF-8\\\/return_url.php\'\\\/><input type=\'hidden\' name=\'charset\' value=\'UTF-8\'\\\/><input type=\'hidden\' name=\'sign\' value=\'RiKpYy40Psh2WELOiUngrK1ByS290pCAmcvh6xOJz\\\/R2UcGp5rdb2FCmnJXPoqFREu3Br8rT\\\/jDClLnJ8PSA8ff3muR9lI+GdJWVNHz1acwFl\\\/OX+V+agjR9v6X430847I2QLvuhmUlVrE0p7l8yiU81Dh2rREYtTtgjMzqtJFpuAZf8l6m03lvqBddk0ED\\\/kO2y5HTspF3yCiWizpDaVZEfAR7ziPqZWUjUTfC1iinLAQG9FMriineOjI5c2VyPRVf0v8QI3w3gVDVNlaC0iXFsrrvS2eeRvrZ\\\/zn083CXlDMYnLV42smz2rZOIoix7\\\/u7DDXiVmx65xlUw9djY5g==\'\\\/><input type=\'submit\' value=\'ok\' style=\'display:none;\'\'><\\\/form><script>document.forms[\'alipaysubmit\'].submit();<\\\/script>\""}';


//        return View::fetch("", [
//            "aa" => $res,
//        ]);


        //          echo Cache::get('count');
//         $value = uniqid();


//         Cache::set('test',$value);
//         print_r(Cache::get('count'));



//        $key = 'good1';
//        $lockKey = config("redis.lock_key");
//        $result = Cache::get($key);
//        $redis = (new RedisLock())->lock($lockKey, 2);
//        print_r($redis);die;




    }

    public function test(){


//        for ($i=0; $i < 100000; $i++)
//        {
//            $count=Cache::get('count');
//            $count=$count+1;
//            Cache::set('count',$count);
//        }
        $lock = new RedisLock();
        $lockName = 'lock_num';
        $start=time();
        for ($i=0; $i < 5000; $i++)
        {

            $identifier=$lock->getLock($lockName);
            if($identifier)
            {
                $count=Cache::get('count');
                $count=$count+1;
                Cache::set('count',$count);
                $lock->releaseLock($lockName,$identifier);
            }
        }
        $end=time();
        echo "this OK<br/>";
        echo "执行时间为：".($end-$start);


    }
    public function del(){


        Cache::delete("count");
    }


//    public function test1(){
//        $a = range(0,3);
//        xdebug_debug_zval('a');
//
//        exit;
//        $a = range(0, 1000);
//        var_dump(memory_get_usage());
//        $b = &$a;
//        var_dump(memory_get_usage());
//        $a = range(0, 1000);
//        var_dump(memory_get_usage());
//
//
//    }



    public function upload(){

        $file = $this->request->file('lawyer');

        $ext = $file->getOriginalExtension();
        if(!in_array( $ext, $this->option['ext'])){
            return error('请上传xls或者xlsx格式');
        }
        $classStats = ClassArr::importClassStat();
        $classObj = ClassArr::initClass('user', $classStats, [], true);
        $res = $classObj->upload($file);
        if(!$res) return error("导入失败");

        return success('成功');

    }


    public function mogodb(){



//        $res = Db::connect("mongo")->table("test")->find(1);

//        $res = Mongodb::getInstance()->update('test', ['id' => 2], ['name' => '小白']);
                $res = Mongodb::getInstance()->paginate('test1','name',1,2);

//        $res = Mongodb::getInstance()->insert('test1',  ['title_id'=>4, 'name' => '小懒','age' => 12]);
//        $id = '5f599685a1269c8375516714';
//        $id = (string)$id;
//        $res = Mongodb::getInstance()->find('test',  $id);

//        $userModel = new Test();
//        $test = $userModel->getTestById(1);
//        halt($test);
        return success($res);

//        $goodModel = new Goods();
//        $test = mysql\Goods::find(1);
//        print_r($test);die;

    }

}