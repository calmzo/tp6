<?php
/**
 * http_server.php
 * User chenzhuo
 * Date 2020/8/19 4:15 下午
 * Description :
 */

$http = new Swoole\Http\Server('0.0.0.0', 8092);

$http->on('request', function ($request, $response) {
    var_dump($request->server);
    $response->header("Content-Type", "text/html; charset=utf-8");
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});

$http->start();
