<?php
namespace app\admin\controller;

use think\Loader;
use think\Session;

class Index extends Base
{   

    protected $header = '后台管理';

    public function index()
    {   
        $this->view->desc = '后台首页';
        $data = Loader::model('Admin')->getOne(Session::get('uid'));
        return $this->fetch('',['list'=>$data]);
    }
  

}
