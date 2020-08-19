<?php
// 连接swoole tco服务

$client = new swoole_client(SWOOLE_SOCK_TCP);

if (!$client->connect("127.0.0.1", 9501)) {
    echo 'connect failture';
    exit;
}

//php cli常量
fwrite(STDIN, "请输入消息：");
$msg = trim(fgets(STDIN));
// 发送消息给tcp server服务器
$client->send($msg);

// 接受来自server的数据
$result = $client->recv();
echo $result;
