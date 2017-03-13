<?php 
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Base extends Controller
{
    public function _initialize()
    {
        if (session('admin_user')) {
            $this->admin = session('admin_user');
        } else {
            $this->redirect('Login/index');
        }
    }
}