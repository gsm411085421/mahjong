<?php

namespace app\worker\controller;

use think\worker\Server;
use app\worker\server\Helper;

/**
 * 信息格式
 * JSON
 * {"uid":1, "url":"controller/action" , "param":{}}
 * 说明:
 *     uid   integer 用户ID
 *     url   string  控制器/方法
 *     param json   方法参数
 */

/**
 * 接口返回码示意：
 *     10000 接收到大厅消息
 *     10001 结算有误
 *     
 *     20001 创建房间
 *     20002 新玩家加入到房间
 *     20003 玩家加入到匹配的房间
 *     20004 玩家准备
 *     20005 提醒准备
 *     20006 提醒结算
 *     20007 提醒结算有误
 *     20008 玩家被踢出
 *     
 *     30000 玩家结算
 *     30001 玩家结算结果
 */
class Worker extends Server
{
    protected $socket = 'websocket://127.0.0.1:2346';


    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        // echo date('m-d H:i:s'),"\t",$data,PHP_EOL;
        // echo $connection->id,PHP_EOL;
        // $connection = Connection::getInstance();
        // dump($connection::$connection);
        // Helper::parseUrl($data, $connection);
         $connection->send('我收到你的信息了');
    }


    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {

    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {

    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }
}