<?php
/**
 * User.php
 * User chenzhuo
 * Date 2020/8/7 11:19 下午
 * Description :
 */
namespace app\api\controller;
use app\BaseController;
use app\common\service\User as UserService;

class User extends BaseController
{
    public function index()
    {
        $user = new UserService();
        $data = $user->index();
        return success($data);
    }

}