<?php


$http = new Swoole\Http\Server("0.0.0.0", 8811);
$http->set([
    'enable_static_handler' => true,
    'document_root' => "/usr/local/webserver/nginx/html",
]
);
$http->on('request', function ($request, $response) {

    //print_r($request->get);
    // 设置cookie
   
    // 设置静态资源
    // /usr/local/webserver/nginx/html
  
     $response->end("sss" . json_encode($request->get));
});
//  $response->cookie("singwa", "xsss", time() + 1800);
$http->start(); 

/* $http = new Swoole\Http\Server("127.0.0.1", 9501);
$http->on('request', function ($request, $response) {
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});
$http->start(); */
