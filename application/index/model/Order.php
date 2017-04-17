<?php
namespace app\index\model;

use think\Loader;

use app\index\model\Goods;
use app\index\model\Member;

class Order extends Base
{
    /**
     * 添加订单
     * @param int $uid     用户ID
     * @param int $goodsId 商品ID
     */
    public function addOrder($uid, $goodsId)
    {
        $goodsModel = new Goods;
        $goodsInfo = $goodsModel->getOne($goodsId);
        if (empty($goodsInfo) || $goodsInfo['goods_num'] < 1) {
            $res = error('商品库存不足');
        } else {
            $userModel = new Member;
            // 用户元宝数量
            $syceeCount = $userModel->where('id', $uid)->value('sycee_num');
            if ($syceeCount < $goodsInfo['price']) {
                $res = error('用户元宝不足');
            } else {
                $this->startTrans();
                try {
                    // 写订单
                    $this->save(['member_id'=>$uid, 'goods_id'=>$goodsId, 'order_num'=>self::_generateOrderNum()]);
                    // 减库存 
                    $goodsModel->reduceInventory($goodsId);
                    // 用户减元宝
                    $res = $userModel->setSycee($uid, $goodsInfo['price']);
                    $this->commit();
                    $res = success(['order'=>$this->toArray()]);
                } catch (\Exception $e) {
                    $this->rollback();
                    $res = error($e->getMessage());
                }
            }
        }
        return $res;
    }

    /**
     * 生成订单号 18位
     * @return string
     */
    private static function _generateOrderNum()
    {
        return date('YmdHis', $_SERVER['REQUEST_TIME']).rand(1000,9999);
    }
}