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

} 