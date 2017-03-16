<?php 
namespace app\admin\validate;
use think\Validate;

class Order extends Validate
{   
    //验证规则
    protected $rule = [
                  'member_id' => 'require|number',
                  'goods_id' => 'require|number',   
                  'order_num' => 'require',
    ];
    protected $message = [
                  'member_id.require' => '会员ID不能为空',
                  'member_id.number' => '会员ID必须是数字',
                  'goods_id.require' => '商品ID不能为空',
                  'goods_id.number' => '商品ID必须是数字',
                  'order_num.require' => '订单编号不能为空',                
                  
    ];   

}