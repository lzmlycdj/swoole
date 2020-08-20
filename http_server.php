<?php 


$http= new Swoole\Http\Server("0.0.0.0",8811);
$http->on('request',function($request,$response){

//print_r($request->get);

$response->end("sss".json_encode($request->get));
});
$http->start(); 

/* $http = new Swoole\Http\Server("127.0.0.1", 9501);
$http->on('request', function ($request, $response) {
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});
$http->start(); */
