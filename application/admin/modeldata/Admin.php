<?php 
namespace app\admin\modeldata;
use think\Db;
use think\helper\Hash;
class Admin 
{
/**
 * 初始化数据
 * @return [type] [description]
 */
    public function initData()
    {
        return [
                  ['user'=>'admin','name'=>'超级管理员','phone'=>15928907435,'password'=>self::_setPasswordMd5("123456")]
        ];
    }
/**
 * Md5加密
 * @param [type] $password [description]
 */
    private function _setPasswordMd5($password)
    {
        // $md5 = new Md5;
        return Hash::make($password);
    }
/**
 * 执行方法
 * @return [type] [description]
 */
    public function run()
    {
        DB::name('admin')->execute('TRUNCATE TABLE tp_admin');

        foreach ($this->initData() as $v) {
            Db::name('admin')->insert($v);
        }
    }
}