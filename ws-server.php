<?php 

$server = new Swoole\WebSocket\Server("0.0.0.0", 9501);
// 设置参数让websocket可以当做普通的http服务器
$server->set([
    'enable_static_handler' => true,
    'document_root' => "/usr/local/webserver/nginx/html",
]
);
// 链接监听
$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
});
// 消息事件
$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},
    opcode:{$frame->opcode},
    fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server lzm");
});

$server->on('close', function ($server, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();
