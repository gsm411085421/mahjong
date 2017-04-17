<?php
/**
 * worker/Connection 测试
 */

namespace app\worker\controller;

use app\worker\server\Connection;

class TestWorker 
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
        $this->testAdd();
    }

    public function testAdd()
    {
        $config = [
            [1, 'con1', 0],
            [2, 'con2', 1],
            [3, 'con3', 1]
        ];
        foreach ($config as $v) {
            $this->connection->add($v[0], $v[1], $v[2]);
        }
        // $this->_echoMethod(__METHOD__);
        // dump($this->connection->getConnections(false));
    }

    public function testGetRoomUser()
    {
        $res = $this->connection->getRoomUser(1);
        $this->_echoMethod(__METHOD__);
        dump($res);
    }

    public function testDeleteUserFromRoom()
    {
        $this->connection->deleteUserFromRoom(2,1);
        $this->_echoMethod(__METHOD__);
        dump($this->connection->getConnections(false));
        dump($this->connection->getRoomUser(1));
    }

    public function testDelete()
    {
        $this->_echoMethod(__METHOD__);
        dump($this->connection->getConnections(false));
        $this->connection->delete(2, false);
        dump($this->connection->getConnections(false));
        dump($this->connection->getRoomUser(1));
    }

    public function testGetConnectionsNotInRoom()
    {
        $this->_echoMethod(__METHOD__);
        dump($this->connection->getConnectionsNotInRoom(false));
    }

    private function _echoMethod($method)
    {
        echo '<h1>',$method,'</h1>','<br>';
    }

    public function testCallUserFun()
    {
        \think\Loader::action('Index/msg', ['name'=>'leon', 'age'=>23]);
        // call_user_func_array([__NAMESPACE__.'\Index','msg'], []);
    }
}