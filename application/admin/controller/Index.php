<?php 
namespace app\admin\controller;
use think\View;

class Index extends Base
{
    public function index()
    {
        //初始化管理员表
        // $initAdmin = new \app\admin\modeldata\Admin;
        // $initAdmin->run();
        return $this->fetch();
    }
}