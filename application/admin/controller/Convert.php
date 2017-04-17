<?php 
namespace app\admin\controller;


class Convert extends Base
{

    const PAGE_SIZE = 3 ;

    /**
     * 会员兑换记录页面
     * @return [type] [description]
     */
    public function withdraw()
    { 
      $this->view->header = '会员中心';
      $this->view->desc = '兑换记录' ; 
      $where = $config = [];
      if($this->request->isGet() && $this->request->has('query') ){
        $get = $this->request->get();
        if(isset($get['status']) && $get['status'] != -1){
          $where['status'] = $config['query']['status'] = $get['status'];
        }
        if(isset($get['search']) && $get['search'] ){
          $where['member_nickname'] = ['like','%'.$get['search'].'%'];
          $config['search'] = $get['search'];
        }
      }
      $data = parent::model()->getConvertList($where,true,self::PAGE_SIZE,$config);
      return $this->fetch('',['data'=>$data]);
    }


       /**
     * 代理兑换记录页面
     * @return [type] [description]
     */
    public function withdrawAgency()
    { 
      $this->view->header = '代理管理';
      $this->view->desc = '兑换记录' ; 
      $where = ['is_agency'=>1]; 
      $config = [];
      if($this->request->isGet() && $this->request->has('query') ){
        $get = $this->request->get();
        if(isset($get['status']) && $get['status'] != -1){
          $where['status'] = $config['query']['status'] = $get['status'];
        }
        if(isset($get['search']) && $get['search'] ){
          $where['member_nickname'] = ['like','%'.$get['search'].'%'];
          $config['search'] = $get['search'];
        }
      }
      $data = parent::model()->getConvertList($where,true,self::PAGE_SIZE,$config);
      return $this->fetch('',['data'=>$data]);
    }


    /**
     * 修改提现状态
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
     * 删除一条提现记录
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