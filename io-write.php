<?php 
$content = date("Ymd H:i:s").PHP_EOL;
swoole_async_writefile(__DIR__."/1.log",$content,
function($filename){
// todo
echo "success".PHP_EOL;
// FILE_APPEND追加模式不会不会覆盖前面的内容
},FILE_APPEND
);

echo "start".PHP_EOL;