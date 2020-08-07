<?php
/**
 * User.php
 * User chenzhuo
 * Date 2020/8/8 12:27 上午
 * Description :
 */

namespace app\common\service;
use app\common\model\mysql\User as UserModel;
class User{

    public function index()
    {
        $model = new UserModel();
        $data = $model->index();
        return $data;
    }

}