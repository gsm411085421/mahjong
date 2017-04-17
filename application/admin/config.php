<?php 
//配置文件
return [

    'img_save_root'    => ROOT_PATH . 'public' . DS . 'uploads'.DS.'images', // 图片上传根路径
    'img_save_url'     => '/uploads/images/',
    //文件上传根目录
    'file_save_root'   => ROOT_PATH . 'public' . DS . 'uploads'.DS.'files',
    'file_save_url'    => '/uploads/files/',
    'upload_img_rule'  => [
                'size' => 2097152,
                'ext'  => 'gif,jpg,jpeg,png',
            ],//验证图片大小,不超过2M 
    'upload_file_ext'  => 'pdf,txt,dot,doc,docx,ppt,xls,xlsx',//验证文件后缀名
    'upload_file_size' => 5242880,//验证上传文件大小,不超过5M
    'excel_ext'        => ['xlsx','xls'],
    'word_ext'         => ['doc','docx'],
    'page_size'        => 10,//每页显示数据条数


    'auth_config' => [
        'auth_on' => true, // 权限认证开关
    ],
    'template'  =>  [
        'layout_on'     =>  true,
        'layout_name'   =>  'layout',
        'tpl_cache'     =>  false,
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