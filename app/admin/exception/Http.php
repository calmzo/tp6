<?php
/**
 * Http.php
 * User chenzhuo
 * Date 2020/8/8 12:53 上午
 * Description :
 */
namespace app\admin\exception;
use think\exception\Handle;
use think\Response;
use Throwable;
class Http extends Handle
{

    public $httpStatus = 500;

    public function render($request, Throwable $e): Response
    {
        // 添加自定义异常处理机制

        return parent::render($request, $e);

    }


}