<?php
/**
 * curl.php
 * User chenzhuo
 * Date 2020/8/20 7:56 下午
 * Description :
 */

echo "process-start".date("Y-m-d H:i:s");
$urls = [
    'http://baidu.com',
    'http://sina.com.cn',
    'http://qq.com1',
    'http://qq.com2',
    'http://qq.com3',
    'http://qq.com4',
    'http://qq.com5',
    'http://qq.com6',

];
$workers = [];
for($i=0; $i<7; $i++){
    //子进程
    $process = new swoole_process(function (swoole_process $worker) use($i, $urls){
        //curl
        $content = curlData($urls[$i]);
//        echo $content.PHP_EOL;
        $worker->write($content.PHP_EOL);
    },true);
    $pid = $process->start();
    $workers[$pid] = $process;
}

foreach ($workers as $worker){
    echo $worker->read();
}

function curlData($url){
    sleep(1);
    return $url .'success'.PHP_EOL;
}

echo "process-end".date("Y-m-d H:i:s");

