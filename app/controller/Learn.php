<?php
/**
 * Class Learn.php
 * User chenzhuo
 * Date 2020/8/7 8:56 下午
 * Description :
 */
namespace app\controller;
//use app\Request;
use app\BaseController;
use think\facade\Request;
class Learn extends BaseController
{

    public function calm() {
        dump(Request::param('name'));
    }

}