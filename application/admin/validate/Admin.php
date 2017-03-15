<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'user'     => 'require|unique:admin|length:5,12',
        'password' => 'confirm|length:6,13',
        'phone'    => 'number|length:11,13'
    ];

    protected $message = [
        'user.require'     => '用户名未填写',
        'user.unique'      => '用户名已存在',
        'user.length'      => '用户名长度在 5 到 12 位之间',
        'password.confirm' => '密码与确认密码不一致',
        'password.length'  => '密码长度在 6 到 13 位之间',
        'phone.number'     => '电话不是一个正确格式',
        'phone.length'     => '电话号码的长度在 11 到 13 位之间'
    ];

    protected $scene = [
        'edit'  => ['user'=>'unique:admin|length:5,12','password','phone'],
    ];
}