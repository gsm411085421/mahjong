<?php
/**
 * 结算
 */

namespace app\worker\controller;

class Clearing extends Base
{
/**
 * 用户结算 监听结算结果
 * @param  int $uid    用户ID
 * @param  int $room   房间ID
 * @param  int $type   结算类型：1 赢， 0 输
 * @param  int $amount 金币数量
 * @return
 */
    public function clear($uid, $room, $type, $amount)
    {
        // 结算数据写表
        
        $arrRoomUesr = $this->connection->getRoomUser($room);
        $res = json_encode([
            'code'   => 30000,
            'url'    => 'clearing/clear',
            'msg'    => '用户结算',
            'uid'    => $uid,
            'type'   => $type,
            'amount' => $amount,
        ], 320);
        foreach ($arrRoomUesr as $user) {
            $this->connection->getConnection($user)->send($res);
        }
        // 当最后一位玩家结算时，计算结算结果
        $clearResult = json_encode([
            'code' => 30001,
            'url'  => 'clearing/clear',
            'msg'  => '结算结果',
            'flag' => 1, // 结果标识 1 正确， 2 错误
        ], 320); // 结算结果
        // 广播结算结果 
        foreach ($arrRoomUesr as $user) {
            $this->connection->getConnection($user)->send($clearResult);
        }
    }
}