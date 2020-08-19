<?php 
$serv = new swoole_server("0.0.0.0",9502,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);

$serv->on('packet',function($serv,$data,$fd)
{
  $serv->sendto($fd['address'],$fd['port'],"server:$data");
  var_dump($fd);
}
);

$serv->start();
 