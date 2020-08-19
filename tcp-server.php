<?php 

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new Swoole\Server("127.0.0.1", 9501); 


// 设置参数
$serv->set([
    'worker_num'=>8,  //worker进程数cpu 1-4
    'max_request'=>10000,  //
    ]);

/**
 * $fd客户端连接的唯一标示
 * $reactor id线程id
 */


//监听连接进入事件
$serv->on('Connect', function ($serv, $fd, $reacotor_id) {  
    echo "Client:{$reacotor_id}----{$fd} Connect.\n";
});

//监听数据接收事件
/**
 * $data 就是客户端发送的数据
 * 
 */
$serv->on('Receive', function ($serv, $fd, $reacotor_id, $data) {
    $serv->send($fd, "Server: {$reacotor_id}----{$fd} ".$data);
});

//监听连接关闭事件
$serv->on('Close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start(); 