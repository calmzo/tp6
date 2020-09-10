<?php
/**
 * process.php
 * User chenzhuo
 * Date 2020/8/20 7:17 下午
 * Description :
 */

$process = new swoole_process(function (swoole_process $pro){
    //todo
    $pro->exec("/usr/local/php/bin/php", [__DIR__.'/../server/http_server.php']);
},false);

$pid = $process->start();
echo $pid . PHP_EOL;

swoole_process::wait();
