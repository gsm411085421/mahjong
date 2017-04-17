<?php
/**
 * 消息收发
 */

namespace app\worker\controller;

// use app\worker\server\Connection;

class Message extends Base
{
/**
 * 推送消息到大厅
 * {"uid":1,"url":"message/msgtohall","param":{"uid":1,"msg":"大家好"}}
 * @param  int $uid 用户 ID
 * @param  string $msg 消息内容
 * @return {"code":10000, "url":"message/msgtohall", userinfo":{"id":1,"avatar":"2.png", "nickname":"hello"}, "msg":"hello world"}
 */
    public function msgToHall($uid, $msg)
    {
        $connectionInstance = $this->connection;
        $userinfo = ['id'=>10, 'avatar'=>'2.png', 'nickanme'=>'hello']; // 读数据库

        $connections = $this->connection->getConnectionsNotInRoom(true, $uid);
        $res = json_encode([
            'code'     => 10000,
            'url'      => 'message/msgtohall',
            'userinfo' => $userinfo,
            'msg'      => $msg
        ], 320);
        foreach ($connections as $con) {
            $con->send($res);
        }
    }
/**
 * 通知结算有误
 * @param  int $from 发送用户 ID
 * @param  int $to   接收用户 ID
 * @param  int $room 房间 ID
 * @return {"code"=>10001, "url":"message/clearingerror", "from":1, "to":2, "room":123, "msg"=>"结算有误"}
 */
    public function clearingError($from, $to, $room)
    {
        $connectionInstance = $this->connection;
        $connection = $connectionInstance->getConnection($to, false);
        if ($connection) {
            if ($connection[$connectionInstance::ROOM] == $room) {
                $res = json_encode([
                    'code' => 10001,
                    'url'  => 'message/clearingerror',
                    'from' => $from,
                    'to'   => $to,
                    'room' => $room,
                    'msg'  => '结算有误'
                ], 320);
                $connection[$connectionInstance::CON]->send($res);
            }
        }
    }
}