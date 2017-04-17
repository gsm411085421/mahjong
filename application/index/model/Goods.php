<?php
namespace app\index\model;

class Goods extends Base
{

    /**
     * 商品库存减一
     * @param  int $id 商品ID 
     * @param  int $count 商品数量
     * @return int
     */
    public function reduceInventory($id, $count = 1)
    {
        return $this->where('id', $id)->setDec('goods_num', $count);
    }
}