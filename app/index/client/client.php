<?php
$client = new Swoole\client(SWOOLE_SOCK_TCP);
if(!$client->connect('127.0.0.1', 9502)){
    exit("connect failed. Error: {$client->errCode}\n");
}

fwrite(STDOUT, "请输入信息");
$msg = trim(fgets(STDIN));

//发送消息给服务端
$client->send($msg);

//接收服务端消息
$res = $client->recv();
echo $res;
$client->close();

