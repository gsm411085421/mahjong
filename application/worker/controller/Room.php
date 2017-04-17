<?php
/**
 * 房间控制器
 *
 * @method  createRoom($uid) 创建房间
 * @method  enterRoom($uid) 进入房间
 * @method  userReady($uid, $room) 用户准备
 * @method  alertReadyMsg($from, $to) 提醒准备
 * @method  alertClearing($from, $to) 提醒结算
 * @method  alertClearingError($from, $to) 提醒结算有误
 * @method  kickingPlayer($uid, $room) 踢人
 */

namespace app\worker\controller;

// use app\worker\server\Connection;

class Room extends Base
{
/**
 * 创建房间
 * @param  int $uid 用户ID
 * @return
 */
    public function createRoom($uid)
    {
        // 写数据库 存储房间信息  从 Request->instance()->param() 中获取房间相关信息  或者 前台ajax创建房间，此处接收房间ID
        
        $room = rand(10000, 99999); // 获取房间 ID  

        // 清空房间连接
        $this->connection->deleteUserFromRoom(true, $room);

        $userConnection = $this->connection->getConnection($uid);
        $this->connection->add($uid, $userConnection, $room);

        $res = json_encode([
            'code' => 20000,
            'url'  => 'room/createroom',
            'msg'  => '创建房间',
            'room' => $room
        ], 320);
        $userConnection->send($res);
    }
/**
 * 进入房间
 * @param  int $uid 用户ID
 * @return
 */
    public function enterRoom($uid)
    {
        $userConnection = $this->connection->getConnection($uid);
        // 系统根据用户选择的玩法匹配到一个房间ID
        $room = rand(10000, 99999);

        $arrRoomUserId = $this->connection->getRoomUser($room); // 分配的房间中的用户 ID

        $this->connection->add($uid, $userConnection, $room);

        $userinfo = []; // 玩家信息

        // 房间中已存在的玩家收到广播
        $entryInfo = json_encode([
            'code'     => 20001,
            'url'      => 'room/enterroom',
            'msg'      => '有玩家进入',
            'room'     => $room,
            'userinfo' => $userinfo,
        ], 320);
        foreach ($arrRoomUserId as $userId) {
            $con = $this->getConnection($userId)->send($entryInfo);
        }
        // 当前玩家收到返回
        $roomInfo = []; // 房间信息
        $roomUserInfo = []; // 房间中已有玩家信息
        $res = json_encode([
            'code'     => 20003, 
            'url'      => 'room/enterroom',
            'msg'      => '进入房间',
            'room'     => $room,
            'roominfo' => $roomInfo,
            'userinfo' => $roomUserInfo,
        ], 320);
        $userConnection->send($res);
    }
/**
 * 房间中的玩家准备
 * @param  int $uid  用户ID
 * @param  int $room 房间ID
 * @return
 */
    public function userReady($uid, $room)
    {
        $connectionInstance = $this->connection;

        $arrRoomUserId = $connectionInstance->getRoomUser($room);
        $res = json_encode([
            'code' => 20004,
            'url'  => 'room/userready',
            'msg'  => '玩家准备',
            'uid'  => $uid
        ], 320);
        foreach ($arrRoomUserId as $userId) {
            $connectionInstance->getConnection($userId)->send($res);
        }
    }
/**
 * 提醒准备
 * @param  int $from 提醒人ID
 * @param  int $to   被提醒人ID
 * @param  int $room 房间ID
 * @return
 */
    public function alertReadyMsg($from, $to)
    {
        $fromUser = []; // 提醒用户信息

        $res = json_encode([
            'code' => 20005,
            'url'  => 'room/alertreadymsg',
            'msg'  => '提醒准备',
            'from' => $fromUser
        ], 320);
        $this->connection->getConnection($to)->send($res);
    }
/**
 * 提醒结算
 * @param  int $from 提醒人ID
 * @param  int $to   被提醒人ID
 * @param  int $room 房间ID
 * @return
 */
    public function alertClearing($from, $to)
    {
        $fromUser = []; // 提醒用户信息

        $res = json_encode([
            'code' => 20006,
            'url'  => 'room/alertclearing',
            'msg'  => '提醒结算',
            'from' => $fromUser
        ], 320);
        $this->connection->getConnection($to)->send($res);
    }

/**
 * 提醒结算有误
 * @param  int $from 提醒人ID
 * @param  int $to   被提醒人ID
 * @param  int $room 房间ID
 * @return
 */
    public function alertClearingError($from, $to)
    {
        $fromUser = []; // 提醒用户信息

        $res = json_encode([
            'code' => 20007,
            'url'  => 'room/alertclearingerror',
            'msg'  => '提醒结算有误',
            'from' => $fromUser
        ], 320);
        $this->connection->getConnection($to)->send($res);
    }
/**
 * 房主踢人
 * @param  int $uid  被请离用户ID
 * @param  int $room 房间ID
 * @return
 */
    public function kickingPlayer($uid, $room)
    {
        $arrRoomUserId = $this->connection->getRoomUser($room);
        if (in_array($uid, $arrRoomUserId)) {
            $res = json_encode([
                'code' => 20008,
                'url'  => 'room/kickingplayer',
                'msg'  => '玩家被踢出',
                'uid'  => $uid,
            ], 320);
            foreach ($arrRoomUserId as $user) {
                $this->connection->getConnection($user)->send($res);
            }
        }
    }
}