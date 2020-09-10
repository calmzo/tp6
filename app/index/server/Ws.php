<?php
/**
 * websocket.php
 * User chenzhuo
 * Date 2020/8/19 5:17 下午
 * Description :
 */

define('HOST', '0.0.0.0');
define('PORT', '08092');


class Ws
{


    public $ws = null;


    public function __construct()
    {
        $this->ws = new Swoole\WebSocket\Server(HOST, PORT);

        $this->ws->set([
            'worker_num' => 2,
            'task_worker_num' => 2
        ]);
        $this->ws->on("open", [$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("task", [$this, 'onTask']);
        $this->ws->on("finish", [$this, 'onFinish']);
        $this->ws->on("close", [$this, 'onClose']);

        $this->ws->start();

    }

    /**
     * 监听ws连接事件
     * @param $ws
     * @param $request
     * User: chenzhuo
     * Date: 2020/8/19 5:29 下午
     */
    public function onOpen($ws, $request) {
        var_dump('连接'.$request->fd);
//        $ws->push($request->fd, 'open-success');
        if($request->fd == 1) {
            swoole_timer_tick(2000, function ($timer_id){
                //每两秒执行
                echo "2s:timeId:{$timer_id}\n";
            });
        }


    }

    /**
     * 监听ws消息事件
     * @param $ws
     * @param $frame
     * User: chenzhuo
     * Date: 2020/8/19 5:28 下午
     */
    public function onMessage($ws, $frame) {
        echo "push-message:{$frame->data}\n";
        $data = [
            'task' => 1,
            'fd' => $frame->fd,
        ];
//        $ws->task($data);
        swoole_timer_after(5000, function () use($ws, $frame) {

           echo "5s-after:\n";
           $ws->push($frame->fd, "server-push".date("Y-m-d H:i:s"));

        });


        $ws->push($frame->fd, "server-push:".date('Y-m-d H:i:s'));

    }



    public function onTask($serv, $taskId, $workerId, $data){
        print_r($data);
        //耗时场景
        sleep(10);
        return "on task finish"; //告诉worker进程
    }


    public function onFinish($serv, $taskId, $data){

        echo "taskId:{$taskId}\n";
        echo "finish-data-success:{$data}";

    }

    /**
     * close
     * @param $ws
     * @param $fd
     * User: chenzhuo
     * Date: 2020/8/19 5:33 下午
     */
    public function onClose($ws, $fd){
        echo "clientid:{$fd}\n";


    }
}

$obj = new Ws();