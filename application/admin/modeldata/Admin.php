<?php 
namespace app\admin\modeldata;

use think\Db;
use think\helper\hash\Md5;

class Admin
{
    public function initAdminData()
    {
        return [
            ['user'=>'超级管理员','name'=>'admin','password'=>self::_setPasswordMd5('admin123'),'last_login_time'=>'2017-03-10 15:16:30','last_login_ip'=>'127.0.0.1','create_at'=>date('Y-m-d H:i:s')],
        ];
    }
/**
 * 密码Md5加密
 * @param [type] $password [description]
 */
    private function _setPasswordMd5($password)
    {
        $md5 = new Md5;
        return $md5->make($password);
    }
/**
 * 执行方法
 * @return [type] [description]
 */
    public function run()
    {
        Db::name('admin')->execute('TRUNCATE TABLE tp_admin');

        foreach ($this->initAdminData() as $v) {
            Db::name('admin')->insert($v);
        }
    }
}