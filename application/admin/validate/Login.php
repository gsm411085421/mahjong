<?php 
namespace app\admin\validate;
use think\Validate;

class Login extends Validate
{   
    //验证规则
    protected $rule = [
                  'name'     =>'require',
                  'password' => 'require'
    ];
    //验证提示
    protected $message = [
                  'name.require' => '账号不能为空',
                  'name.require' => '密码不能为空'
    ];
}