<?php
namespace app\admin\controller;

use think\Session;
use think\Db;

class Index extends Base
{   

    protected $header = '后台管理';

    public function index()
    {   
        $this->view->desc = '后台首页';
        $id = Session::get('uid'); 
        $data = Db::name('admin')->where('id',$id)->find(); 
        $data['last_login_ip'] = long2ip($data['last_login_ip']);
        return $this->fetch('',['list'=>$data]);
    }
  

}
