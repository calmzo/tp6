<?php
/**
 * User.php
 * User chenzhuo
 * Date 2020/8/7 11:18 下午
 * Description :
 */
namespace app\common\model\mysql;
use think\model;
class User extends Model
{

    public function index()
    {
        return $this->select();
    }


    public function getStatusTextAttr($value, $data) {
       $status = [
           1 => '正常',
           0 => '封禁'
       ];
       return $status[$data['status']];
    }


}