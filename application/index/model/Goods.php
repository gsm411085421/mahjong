<?php  
namespace app\index\model;

class Goods extends Base
{
    /**
     * 查询在售状态的商品
     * @return [type] [description]
     */
    public function showGoods()
    {
        return $this->where('status',1)->select();
    } 

}