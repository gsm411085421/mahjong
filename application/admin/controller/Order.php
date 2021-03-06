<?php  
namespace app\admin\controller;


class Order extends Base
{   

    protected $header = '商城管理';

    const PAGE_SIZE = 4 ;
    /**
     * 订单管理页面
     */
    public function Order()
    {
        $this->view->desc = '订单管理';
        $where = $config = [];
        if($this->request->isGet() && $this->request->has('query') ){
            $get = $this->request->get();
            if(isset($get['status']) && $get['status'] != -1 ){
                $where['status'] = $config['query']['status'] = $get['status'];
            }
            if(isset($get['search']) && $get['search'] ){
                $where['order_num'] = ['like','%'.$get['search'].'%'];
                $config['query']['search'] = $get['search'];
            } 
        }
        $data = parent::model()->getPaginateByTime($where,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }


    /**
     * 删除一条订单
     * @return [type] [description]
     */
    public function deleteOrder()
    {
        if($this->request->isPost()){
            $data = $this->request->Post();
            return parent::model()->deleteOne($data['id']);
        }
    }

    /**
     * 改变订单状态
     * @return [type] [description]
     */
    public function changeStatus()
    {
        if($this->request->isPost()){
            $data = $this->request->Post();
            $res = parent::model()->setStatus($data['status'],['id'=>$data['id']]);
            if($res){
                $res = parent::model()->changeUpdate($data['id']);
                if($res){
                    $handle = ['code'=>1,'msg'=>'修改成功'];
                }else{
                    $handle = ['code'=>0,'msg'=>'修改失败'];
                }
            }else{
                $handle = ['code'=>0,'msg'=>'修改失败'];
            }
            return $handle;
        }
    }


    /**
     * 获取一条订单详情
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function orderDetail($id)
    {   
        $this->view->desc = '订单详情';
        $data = parent::model()->getOrderDetail($id);
        return $this->fetch('',['list'=>$data]);
    }

}