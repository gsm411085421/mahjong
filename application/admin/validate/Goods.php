<?php 
namespace app\admin\validate;
use think\Validate;

class Goods extends Validate
{   
    //验证规则
    protected $rule = [
                  'name'         => 'require|max:15',
                  'price'        => 'require|number',   
                  'goods_num'    => 'require|number',
                  'goods_detail' => 'require',
                  'goods_img'    => 'require',
    ];
    protected $message = [
                  'name.require' => '商品名字不能为空',
                  'name.max' => '商品名字不能超过15个字符',
                  'price.require' => '商品价格不能为空',
                  'price.number' => '商品价格必须是数字',
                  'goods_num.require' => '商品数量不能为空',
                  'goods_num.number' => '商品数量必须是数字',
                  'goods_detail.require' => '商品详情不能为空',
                  'goods_img.require' => '请先上传图片',
                  
                  
    ];   

}