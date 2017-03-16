<?php 
namespace app\admin\validate;
use think\Validate;

class Notice extends Validate
{   
    //验证规则
    protected $rule = [
                  'title'     => 'require',
                  'content'   => 'require',   

    ];
    protected $message = [
                  'title.require' => '公告名字不能为空',
                  'content.require' => '公告内容不能为空',
                            
    ];   

}