<?php  
namespace app\admin\controller;

use think\Loader;


class Order extends Base
{   

    protected $header = '商城管理';

    /**
     * 订单管理页面
     */
    public function Order()
    {
        $this->view->desc = '订单管理';
        $data = Loader::model('Order')->showOrder();
        return $this->fetch('',[
            'list'=>$data,
            ]);
    }


    /**
     *  存入一条订单
     * @return [type] [description]
     */
    public function saveOrder()
    {
        if($this->request->isPost()){
            $input = $this->request->post();
            return Loader::model('Order')->saveOrder($input);
        }
    }

    /**
     * 删除一条订单
     * @return [type] [description]
     */
    public function deleteOrder()
    {
        if($this->request->isPost()){
            $data = $this->request->Post();
            return Loader::model('Order')->deleteOrder($data['id']);
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
                $res = Loader::model('Order')->changeUpdate($data['id']);
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


}