<?php
/**
 * udp.php
 * User chenzhuo
 * Date 2020/8/19 4:08 下午
 * Description :
 */
$server = new Swoole\Server('127.0.0.1', 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
//监听数据接收事件
$server->on('Packet', function ($server, $data, $clientInfo) {
    var_dump($clientInfo);
    $server->sendto($clientInfo['address'], $clientInfo['port'], 'Server：' . $data);
});
//启动服务器
$server->start();
