<?php
/**
 * 业务逻辑处理基础控制器
 */

namespace app\worker\controller;

use app\worker\server\Connection;

class Base
{
    /** @var object 连接实例 */
    protected $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }
}