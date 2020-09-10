<?php
/**
 * ws_server.php
 * User chenzhuo
 * Date 2020/8/19 4:49 下午
 * Description :
 */

$ws = new Swoole\WebSocket\Server('0.0.0.0', 8092);
//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    var_dump($request->fd);
    $ws->push($request->fd, 'open-success');
});
//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "message-success: {$frame->data}");
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();