<?php

/***
 * 
 * ws 优化 基础类库
 */

class Ws
{
    const HOST = "0.0.0.0";
    const PORT = "8812";
    public $ws = null;
    public function __construct()
    {
        $this->ws = new Swoole\WebSocket\Server("0.0.0.0", 8812);
        $this->ws->set(
            [
                'workder_num' => 2,
                'task_worker_num' => 2,
            ]
        );


        $this->ws->on("open", [$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("task", [$this, 'onTask']);
        $this->ws->on("finish", [$this, 'onFinish']);
        $this->ws->on("close", [$this, 'onClose']);

        $this->ws->start();
    }

    /***
     * 监听ws连接事件
     */

    public function onOpen($ws, $request)
    {
        var_dump($request->fd);
    }
    /***
     * 监听ws消息事件
     */
    public function onMessage($ws, $frame)
    {
        //    打印websoket客户端发送的信息

        echo "ser-push-message:{$frame->data}\n";
        // todo 10s  task机制-
        $data = [
            'task' => 1,
            'fd' => $frame->fd,
        ];
        // 开始投放任务->投递异步任务10s后完成
        $ws->task($data);
        $ws->push($frame->fd, "server-push:" . date("Y-m-d H:i:s"));
    }
    // 这个$data是上面投递过来的数据
    public function onTask($serv, $taskId, $workerId, $data)
    {
        print_r($data);
        sleep(10);
        return 'on task finish'; //告诉worker
    }
    // 下面这里的$data是'on task finish
    public function onFinish($serv, $taskId, $data)
    {
        echo "taskId:{$taskId}\n";
        echo "finish-data-sucess:{$data}\n";
    }


    /***
     * 关闭连接
     */
    public function onClose($ws, $fd)
    {
        echo "client:{$fd}\n";
    }
}

$obj = new Ws();
