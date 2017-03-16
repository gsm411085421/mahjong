<?php 
namespace app\admin\validate;
use think\Validate;

class WithdrawApply extends Validate
{   
    //验证规则
    protected $rule = [
                  'member_id' => 'require|number',
                  'money' => 'require|number',   
                  'admin_id' => 'require|number|max:5',
    ];
    protected $message = [
                  'member_id.require' => '会员ID不能为空',
                  'member_id.number' => '会员ID必须为数字',
                  'money.require' => '提现金额不能为空',
                  'money.number' => '提现金额必须是数字',
                  'admin_id.require' => '客服ID不能为空', 
                  'admin_id.number' => '客服ID必须为数字',
                  'admin_id.max' => '客服ID不能超过5位',                             
    ];   

}