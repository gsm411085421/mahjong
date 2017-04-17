<?php
/**
 * 商城
 */

namespace app\index\controller;


class Goods extends Base
{

    /**
     * 商城页面
     * @return [type] [description]
     */
    public function mall()
    {   
        $data = parent::model()->getAll();
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 下订单
     * @return [type] [description]
     */
    public function makeOrder()
    {
        if ($this->request->isPost()) {
            $goodsId = $this->request->post('goods_id');
            $info = parent::model('Order')->addOrder($this->uid, $goodsId);
            if ($info['code']) {
                parent::refreshUserSession(); // 刷新用户 session
            }
            return $info;
        }
        return error('请求非法');
    }
}