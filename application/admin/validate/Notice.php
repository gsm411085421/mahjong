<?php 
namespace app\admin\validate;
use think\Validate;

class Notice extends Validate
{
    //验证规则
    protected $rule = [
                  'title'   => 'require|max:15',
                  'content' => 'require'
    ];
    //提示信息
    protected $message = [
                  'title.require'   => '标题不能为空',
                  'title.max'       => '标题不能超过15个字符',
                  'content.require' => '内容不能为空'
    ];
}