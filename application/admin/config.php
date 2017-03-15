<?php 
//配置文件
return [
    'auth_config' => [
        'auth_on' => true, // 权限认证开关
    ],
    'template'  =>  [
        'layout_on'     =>  true,
    ],
    'var_pjax' => 'X-PJAX',

    'session' => [
        'prefix' => 'admin_', // 后台 session 前缀
    ],

    // 自定义
    // session 名称
    'session_name' => [
        'uid'   => 'uid', // 后台登录用户 ID
        'uinfo' => 'uinfo', // 后台登录用户信息
    ],
];