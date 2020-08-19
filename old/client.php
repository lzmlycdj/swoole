<?php 
$client = new Swoole\client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_SYNC);
if($client->connect('139.155.37.227',9501)){
    $client->send('peter');
}

 $response = $client->recv();
 echo $response.PHP_EOL;
$client->close();