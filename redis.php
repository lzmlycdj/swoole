<?php 
$client = new swoole_redis;
$client->connect('127.0.0.1', 6379, function (swoole_redis $client, $result) {
  
    /* echo "connect".PHP_EOL;
    var_dump($result);
    $client->set('singwa_1',time(),
    function(swoole_redis $client,$result){
        var_dump($result);
    } 
    );
    */

    /* $client->get('singwa_1',function (swoole_redis $client, $result){
        var_dump($result);
        $client->close();
    }); */

// 获取所有的keys
   /*  $client->keys('*',function (swoole_redis $client, $result){
        var_dump($result);
    }); */
// redis异步模糊匹配
     $client->keys('*gw*',function (swoole_redis $client, $result){
        var_dump($result);
    });
});

echo "start".PHP_EOL;