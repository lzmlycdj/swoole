<?php 

$serv = new swoole_http_server("0.0.0.0",9501);

$serv->on('request',function($request,$response){
var_dump($response);
$response->header("content-Type","text/html;charset=utf-8");
$response->end("hello world".rand(100,999));
});

$serv->start();