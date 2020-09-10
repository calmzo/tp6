<?php
/**
 * redis.php
 * User chenzhuo
 * Date 2020/8/20 8:37 下午
 * Description :
 */


$http = new swoole_http_server('0.0.0.0',8092);
$http->on('request', function ($request, $response) {

    //获取key输出到浏览器
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect('127.0.0.1','6379');
//    $redis->set('calm','chenz');
    $value = $redis->get($request->get['a']);
    $response->header('Content-Type', 'text-plain');
    $response->end($value);
});

$http->start();
