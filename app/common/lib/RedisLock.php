<?php
/**
 * Lock.php
 * User chenzhuo
 * Date 2020/8/24 1:46 下午
 * Description :
 */
namespace app\common\lib;
use think\cache\driver\Redis;

define("PREFIX", config("redis.lock_expire"));
define("KEY", config("redis.lock_key"));


class RedisLock extends Redis
{

    /**
     * @desc 加锁方法
     *
     * @param $lockName string | 锁的名字
     * @param $timeout int | 锁的过期时间
     *
     * @return 成功返回identifier/失败返回false
     */
    public function getLock($lockName){
//        $identifier=uniqid();  #获取唯一标识符
        $identifier = time();
        $timeout=ceil(PREFIX); #确保是整数
        $end=time()+$timeout;

        while(time()<$end)   #循环获取锁
        {
            if(self::setnx($lockName, $identifier)) #查看$lockName是否被上锁
            {
                self::expire($lockName, $timeout);  #为$lockName设置过期时间，防止死锁

                return $identifier;        #返回一维标识符
            }
            elseif (self::ttl($lockName)===-1)
            {
                self::expire($lockName, $timeout);  #检测是否有设置过期时间，没有则加上（假设，客户端A上一步没能设置时间就进程奔溃了，客户端B就可检测出来，并设置时间）
            }
            usleep(0.001);   #停止0.001ms
        }
        return false;
    }


    /**
     * 释放锁
     * @param $lockName | 锁名
     * @param $identifier | 锁的唯一值
     * @return bool
     * User: chenzhuo
     * Date: 2020/8/24 2:42 下午
     */
    public function releaseLock($lockName,$identifier)
    {
        if(self::get($lockName)==$identifier) #判断是锁有没有被其他客户端修改
        {
            self::multi();
            self::del($lockName); #释放锁
            self::exec();
            return true;
        }
        else
        {
            return false; #其他客户端修改了锁，不能删除别人的锁
        }
    }



}