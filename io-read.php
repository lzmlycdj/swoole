<?php 
/* swoole_async_read异步读文件，使用此函数读取文件是非阻塞的，当读操作完成时会自动回调指定的函数。
bool swoole_async_read（string $filename，mixed $callback，int $size = 8192，int $offset =0）；此函数与swoole-async-readfile不同，它是分段读取，可以用于读取超大文件。每次只读$size个字节，不会占用太多内存
在读完后会自动回调$callback函数，回调函数接受2个参数：bool callback（string $filename，string $content）；Sfilename，文件名称
$content，读取到的分段内容，如果内容为空，表明文件已读完 */

swoole_async_readfile(__DIR__."/1.txt",
function($filename,$fileContent){
    echo "filename:".$filename.PHP_EOL;
    echo "content:".$fileContent.PHP_EOL;
}

);
// 异步测试

var_dump($result);
echo "start".PHP_EOL;