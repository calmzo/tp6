<?php
/**
 * 漏斗限流
 * User chenzhuo
 * Date 2020/8/25 5:44 下午
 * Description :
 */
namespace app\common\lib;

class Funnel
{
    private $capacity;
    private $leakingRate;
    private $leftQuote;
    private $leakingTs;

    public function __construct($capacity, $leakingRate)
    {
        $this->capacity = $capacity;    //漏斗容量
        $this->leakingRate = $leakingRate;//漏斗流水速率
        $this->leftQuote = $capacity; //漏斗剩余空间
        $this->leakingTs = time(); //上一次漏水时间
    }

    public function makeSpace()
    {
        $now = time();
        $deltaTs = $now-$this->leakingTs; //距离上一次漏水过去了多久
        $deltaQuota = $deltaTs * $this->leakingRate; //可腾出的空间
        if($deltaQuota < 1) {
            return;
        }
        $this->leftQuote += $deltaQuota;   //增加剩余空间
        $this->leakingTs = time();         //记录漏水时间
        if($this->leftQuota > $this->capacaty){
            $this->leftQuote = $this->capacity;
        }
    }

    public function watering($quota)
    {
        $this->makeSpace(); //漏水操作
        if($this->leftQuote >= $quota) {
            $this->leftQuote -= $quota;
            return true;
        }
        return false;
    }
}