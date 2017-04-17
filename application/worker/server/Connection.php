<?php
/**
 * 连接管理
 *
 * @method  Object getInstance() 连接实例
 * @method  bool   isExists($uid) 连接是否存在
 * @method  Object getConnection($uid, $onlyConnection = true) 通过UID获取连接对象
 * @method  array  getConnections(bool $onlyConnection=true) 获取所有连接
 * @method  array  getConnectionsNotInRoom($onlyConnection = true, $unexpectedUid = false) 获取不在房间中的连接
 * @method  array  getRoomUser($roomId)  获取房间内的所有用户ID
 * @method  void   deleteUserFromRoom($uid, $room) 从房间中删除用户
 * @method  void   add($uid, $con, $room=0)  添加连接
 * @method  void   delete($uid, $deleteFromRoom=true)  删除连接，并从房间中移出
 * @method  void   correctRoomUser()      存储纠错
 */
namespace app\worker\server;

class Connection 
{
    /** CONST string  连接存储索引名*/
    const CON  = 'con';
    /** CONST string  房间 ID 存储索引名*/
    const ROOM = 'room';
    /**
     * 连接存储 用户 ID 作索引
     * ['id'=> [con'=>'', 'room'=>1]]
     * @var array
     */
    public static $connection;
    /**
     * 房间用户缓存 房间 ID 作索引
     * ['id'=>['uid1', 'uid2', ..]]
     * @var array
     */
    public static $roomUser;

    /** @var object 实例 */
    protected static $instance;

    public function __construct()
    {
        
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

/**
 * 用户连接是否存在
 * @param  int  $uid 用户ID
 * @return boolean
 */
    public static function isExists($uid)
    {
        return isset(self::$connection[$uid]);
    }
/**
 * 通过 uid 获取连接
 * @param  int $uid 
 * @return Object
 */
    public static function getConnection($uid, $onlyConnection = true)
    {
        if (self::isExists($uid)) {
            $res = $onlyConnection ? self::$connection[$uid][self::CON] : self::$connection[$uid];
        } else {
            $res = false;
        }
        return $res;
    }
/**
 * 获取所有连接
 * @param  bool  $onlyConnection  仅获取连接对象
 * @return [type] [description]
 */
    public static function getConnections($onlyConnection = true)
    {
        if ($onlyConnection) {
            $res = [];
            foreach (self::$connection as $con) {
                $res[] = $con[self::CON];
            }
            return $res;
        }
        return self::$connection;
    }
/**
 * 获取不在房间中的连接
 * @param  boolean $onlyConnection 是否仅获取连接对象
 * @return array
 */
    public static function getConnectionsNotInRoom($onlyConnection = true, $unexpectedUid = false)
    {
        $res = [];
        if ($onlyConnection) { // 仅连接
            if (false == $unexpectedUid) {
                foreach (self::$connection as $con) {
                    if ($con[self::ROOM] == 0) {
                        $res[] = $con[self::CON];
                    }
                }
            } else {
                foreach (self::$connection as $uid=>$con) {
                    if ($unexpectedUid != $uid) {
                        if ($con[self::ROOM] == 0) {
                            $res[] = $con[self::CON];
                        }
                    }
                }
            }
        } else {
            if (false == $unexpectedUid) {
                foreach (self::$connection as $uid=>$con) {
                    if ($con[self::ROOM] == 0) {
                        $res[$uid] = $con;
                    }
                }
            } else {
                foreach (self::$connection as $uid=>$con) {
                    if ($con[self::ROOM] == 0) {
                        if ($uid != $unexpectedUid) {
                            $res[$uid] = $con;
                        }
                    }
                }
            }
        }
        return $res;
    }
/**
 * 获取房间中的用户 ID
 * @param  int $roomId 
 * @return array
 */
    public static function getRoomUser($roomId)
    {
        return isset(self::$roomUser[$roomId]) ? self::$roomUser[$roomId] : [];
    }

/**
 * 从房间中删除用户
 * @param  int $uid  用户ID 为true时清空房间
 * @param  int $room 房间ID
 */
    public static function deleteUserFromRoom($uid, $room)
    {
        $uid  =  $uid === true ? true : intval($uid);
        $room = intval($room);
        if (true !== $uid &&  self::isExists($uid)) {
            self::$connection[$uid][self::ROOM] = 0;
            if (isset(self::$roomUser[$room])) {
                $key = array_search($uid, self::$roomUser[$room]);
                if (false !== $key) {
                    array_splice(self::$roomUser[$room], $key, 1);
                }
            }
        } elseif (true === $uid) {
            if (isset(self::$roomUser[$room])) {
                self::$roomUser[$room] = [];
            }
        }
    }
/**
 * 添加连接
 * @param int  $uid  用户ID
 * @param object  $con  连接对象
 * @param int $room 房间ID
 */
    public static function add($uid, $con, $room=0)
    {
        $uid  = intval($uid);
        $room = intval($room);
        if (self::isExists($uid)) {
            $roomId = self::$connection[$uid][self::ROOM];
            if ($roomId == $room) { // 连接已存在且房间 ID 未更改，不执行操作
                return false;
            }
        }
        self::$connection[$uid] = [self::CON=>$con, self::ROOM=>$room];
        if ($room) {
            if (isset(self::$roomUser[$room])) {
                if (! in_array($room, self::$roomUser[$room])) {
                    self::$roomUser[$room][] = $uid;
                }
            } else {
                self::$roomUser[$room][0] = $uid;
            }
        }
    }
/**
 * 删除连接 并从房间中移出
 * @param  int  $uid  用户ID
 * @param  bool $deleteFromRoom 是否从房间中移出
 */
    public static function delete($uid, $deleteFromRoom=true)
    {
        $uid  = intval($uid);

        if (self::isExists($uid)) {
            $room = self::$connection[$uid][self::ROOM];
            unset(self::$connection[$uid]);

            if ($room && $deleteFromRoom) {
                self::deleteUserFromRoom($uid, $room);
            }
        }
    }
/**
 * RoomUser 存储纠错
 */
    public static function correctRoomUser()
    {
        $room = [];
        foreach (self::$connection as $uid=>$info) {
            if ($info[self::ROOM]) {
                $room[$info[self::ROOM]][] = $uid;
            }
        }
        self::$roomUser = $room;
    }
}