<?php  
namespace app\admin\controller;


class Recharge extends Base
{

    protected $header = '充值记录';

    const PAGE_SIZE = 4 ;

    /**
     * 会员充值记录页面
     * @return [type] [description]
     */
    public function recharge()
    {    
      $this->view->desc = '充值记录'; 
      $where = $config = [];
      if($this->request->isGet() && $this->request->has('query') ){
        $get = $this->request->get();
        if(isset($get['status']) && $get['status'] != -1){
          $where['status'] = $config['query']['status'] = $get['status'];
        }
        if(isset($get['search']) && $get['search'] ){
          $where['member_id'] = ['like','%'.$get['search'].'%'];
          $config['query']['search'] = $get['search'];
        }
      }
      $data = parent::model()->getRechargeList($where,true,self::PAGE_SIZE,$config);
      return $this->fetch('',['data'=>$data]);
    }

        /**
     * 修改充值状态
     */
    public function setStatus()
    {
      if($this->request->isPost()){
        $data = $this->request->post();
        $res =  parent::model()->setStatus($data['status'],['id'=>$data['id']]);
        if($res){
          return ['code'=>1,'msg'=>'修改成功'];
        }else{
          return ['code'=>0,'msg'=>'修改失败'];
        }
      }
    }

    /**
     * 删除一条充值记录
     * @return [type] [description]
     */
    public function deleteOne()
    {
      if($this->request->isPost()){
        $data = $this->request->post();
        $res = parent::model()->deleteOne($data['id']);
        if($res){
          return ['code'=>1,'msg'=>'删除成功'];
        }else{
          return ['code'=>0,'msg'=>'删除失败'];
        }
      }
    }

}