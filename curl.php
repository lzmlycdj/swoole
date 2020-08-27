<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 18/3/17
 * Time: 涓婂崍12:31
 */

echo "process-start-time:".date("Ymd H:i:s");
$workers = [];
$urls = [
    'http://baidu.com',
    'http://sina.com.cn',
    'http://qq.com',
    'http://baidu.com?search=singwa',
    'http://baidu.com?search=singwa2',
    'http://baidu.com?search=imooc',
];

for($i = 0; $i < 6; $i++) {
    // 瀛愯繘绋?
    $process = new swoole_process(function(swoole_process $worker) use($i, $urls) {
        // curl
        $content = curlData($urls[$i]);
        //echo $content.PHP_EOL;
        // 写true就是把内容写到管道里面去，不能打印到桌面
        $worker->write($content.PHP_EOL);
    }, true);
    $pid = $process->start();
    $workers[$pid] = $process;
}
// 获取管道里面的内容
foreach($workers as $process) {
    echo $process->read();
}
/**
 * 妯℃嫙璇锋眰URL鐨勫唴瀹? 1s
 * @param $url
 * @return string
 */
function curlData($url) {
    // curl file_get_contents
    sleep(1);
    return $url . "success".PHP_EOL;
}
echo "process-end-time:".date("Ymd H:i:s");