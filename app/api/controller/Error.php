<?php
/**
 * Error.php
 * User chenzhuo
 * Date 2020/8/7 9:55 下午
 * Description :
 */
namespace app\api\apicontroller;
class Error
{

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return error("找不到该方法", null, config('status.action_not_found'));
    }
}