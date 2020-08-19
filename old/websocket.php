<?php 

$server = new Swoole\Websocket\Server("0.0.0.0",9502);

$server->on('message',
function($server,$frame){
//   var_dump($frame);  

//   
$list = $server->connection_list();
var_dump($list);
foreach($list as $fd){
  $server->push($fd,'sfasfasfaf');
}
   
}


);
$server->start();