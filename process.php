<?php 
$process = new swoole_process (function (swoole_process $pro) {
    //todo
    //php redis.php
    $pro->exec("/usr/local/php/bin/php",[__DIR__.'/http_server.php']);
}, false);
$pid = $process->start();
echo $pid.PHP_EOL; 
swoole_process::wait();