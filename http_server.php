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

    // 运用异步写模拟请求日志并记录到文件里面去
$content=[
    "date:"=>date("Ymd H:i:s"),
    'get:'=>$request->get,
    'post:'=>$request->post,
    'header'=>$request->header,
];
swoole_async_writefile(__DIR__."/access.log",json_encode($content).PHP_EOL,
function($filename){
    //todo
},FILE_APPEND);
  
$response->end("sss" . json_encode($request->get));
});
//  $response->cookie("singwa", "xsss", time() + 1800);
$http->start(); 

/* $http = new Swoole\Http\Server("127.0.0.1", 9501);
$http->on('request', function ($request, $response) {
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});
$http->start(); */
