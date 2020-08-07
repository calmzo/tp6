<?php
/**
 * User.php
 * User chenzhuo
 * Date 2020/8/7 11:19 下午
 * Description :
 */
namespace app\controller;
use app\BaseController;
use app\common\model\User as UserModel;
class User extends BaseController
{
    public function index(UserModel $model)
    {
        $data = $model::select();
        return success($data);
    }

}