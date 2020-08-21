<?php 
/***
 * 
 * ws 优化 基础类库
 */

 class Ws {
     CONST HOST = "0.0.0.0";
     CONST PORT = "8812";
     public $ws = null;
     public function __construct()
     {
       $this->ws = new Swoole\WebSocket\Server("0.0.0.0", 8812);
       $this->ws->on("open", [$this,'onOpen']);
       $this->ws->on("message",[$this,'onMessage']);
       $this->ws->on("close",[$this,'onClose']);
       $this->ws->start();
     }

    /***
     * 监听ws连接事件
     */

     public function onOpen($ws,$request){
         var_dump($request->fd);
     }
 /***
     * 监听ws消息事件
     */
     public function onMessage($ws,$frame){
        echo "ser-push-message:{$frame->date}\n";
        $ws->push($frame->fd,"server-push:".date("Y-m-d H:i:s"));
    }
 /***
     * 关闭连接
     */
    public function onClose($ws,$fd){
        echo "client:{$fd}\n";
    }

 }

 $obj = new Ws();