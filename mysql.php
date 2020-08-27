<?php

// 怎么让局域网内的其他机子连接我本地数据库
// https://www.cnblogs.com/dengtang/p/11346090.html
class AsyMysql
{
    public $dbSource = "";
    public $dbConfig = [];

    public function __construct()
    {
        // new swoole_mysql;
        $this->dbSource = new Swoole\Mysql;
        $this->dbConfig = [
            'host' => '192.168.1.101',
            'port' => 3306,
            'user' => 'lzmremote',
            'password' => 'root',
            'database' => 'test',
            'charset' => 'utf8',
        ];
    }


    public function update()
    {
    }
    public function add()
    {
    }
    public function execute($id, $username) {
        // connect
        $this->dbSource->connect($this->dbConfig, function($db, $result) use($id, $username)  {
            echo "mysql-connect".PHP_EOL;
            if($result === false) {
                var_dump($db->connect_error);
                // todo
            }

            //$sql = "select * from test where id=1";
            $sql = "select * from actor where id=1";
            // insert into
            // query (add select update delete)
            $db->query($sql, function($db, $result){
                // select => result返回的是 查询的结果内容

                if($result === false) {
                    // todo
                    var_dump($db->error);
                }elseif($result === true) {// add update delete
                    // todo
                    var_dump($db->affected_rows);
                }else {
                    print_r($result);
                }
                // 关闭连接
                $db->close();
            });

        });
        return true;
    }
}

$obj = new AsyMysql();

$obj->execute(1, 'lzm');
// 异步连接测试
var_dump($flag).PHP_EOL;
echo "start".PHP_EOL;
// 运用场景
//详情页-》mysql（阅读数）-> msyql文章+1-》页面数据呈现出来