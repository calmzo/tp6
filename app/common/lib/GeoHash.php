<?php
/**
 * GeoHash.php
 * User chenzhuo
 * Date 2020/8/25 6:13 下午
 * Description :
 */
namespace app\common\lib;
use app\common\lib\nosql\SRedis;
use think\facade\Cache;
use think\facade\Config;

class GeoHash
{
    private $redis;

    public function __construct()
    {
        $sredis = new SRedis();
        $this->redis = $sredis->getInstansOf();
    }


    /**
     * 添加位置
     * @param $code 位置标识
     * @param $lang 经度
     * @param $lat 纬度
     * @return bool
     * User: chenzhuo
     * Date: 2020/8/25 6:36 下午
     */
    public function geoAdd($code, $lang, $lat){
       $this->redis->geoadd(Config::get("GeoHash.geo_key"), $lang, $lat, $code);
        return true;
    }

    /**
     * 获取两点之间距离
     * @param $code1 1点
     * @param $code2 2点
     * @param string $unit 单位  m km ml ft 代表 米 千米 英里 尺
     * @return mixed
     * User: chenzhuo
     * Date: 2020/8/25 6:34 下午
     */
    public function geodist($code1, $code2, $unit = 'km'){

        $res = $this->redis->geodist(Config::get("GeoHash.geo_key"), $code1, $code2 , 'km');
        return $res;
    }

    /**
     * 获取元素位置
     * @param mixed ...$code
     * @return mixed
     * User: chenzhuo
     * Date: 2020/8/26 8:58 上午
     */
    public function getGeo(...$code){
        $res =  $this->redis->geoPos(Config::get("GeoHash.geo_key"), ...$code);
        return $res;

    }
    /**
     * 获取附近的公司 不会排除自身
     * @param $member code
     * @param $radius 半径
     * @param $units 单位
     * @param $option 搜索个数
     * @return mixed
     * User: chenzhuo
     * Date: 2020/8/26 9:05 上午
     */
    public function geoRadius(string $member, int $radius, string $units, int $option){
        //WITHCOORD ==  返回目标的经纬度
        //WITHDIST == 返回距离中心点的距离
        //WITHHASH 返回 52位 无符号整数的 geohash 有序集合分数
        //ASC|DESC 正序排序|倒序排序
        //COUNT = 返回条数
        $res = $this->redis->georadiusbymember(Config::get("GeoHash.geo_key"), $member, $radius, $units, ['WITHCOORD', 'WITHDIST', 'ASC', 'COUNT' => $option]);
        return $res;

    }

}