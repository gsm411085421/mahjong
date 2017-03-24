<?php
namespace app\admin\model;

class Order extends Base
{

    /**
     * 分页显示订单
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function showOrder($page=7)
    {
        return  $this->field(true)->paginate($page);
    }

    /**
     * 存入一条订单
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    public function saveOrder(array $input)
    {
        return parent::addOne($input);
    }

    /**
     *  删除一条订单
     * @return [type] [description]
     */
    public function deleteOrder($id)
    {  
       return parent::deleteOne($id);
    }

    /**
     * 订单处理后更新时间
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function changeUpdate($id)
    {   
        return parent::changeUpdate($id);
    }

    /**
     * 关联会员详情表
     * @return [type] [description]
     */
    public function memberProfile()
    {
        return $this->belongsTo('MemberProfile','member_id','member_id')->field('member_id,name,phone,qq,wechat,panda_id,landlords_id');
    }

    /**
     * 关联商品表
     * @return [type] [description]
     */
    public function goods()
    {
        return $this->belongsTo('Goods','goods_id','id')->field('id,name,price,goods_standard,goods_img,status');
    }

    /**
     * 关联会员表
     * @return [type] [description]
     */
    public function member()
    {
        return $this->belongsTo('member','member_id','id')->field('id,nickname,head_img,status');
    }

    /**
     * 获得一条订单的详细信息
     * @return [type] [description]
     */
    public function getOrderDetail($id)
    {   
        return self::with('memberProfile,goods,member')->where('id',$id)->find()->toArray();
    }

} 