<?php  
namespace app\admin\controller;

class ComplainsRecords extends Base
{   
    protected $header = '结算管理' ;

    const PAGE_SIZE = 2 ;


    /**
     * 投诉记录页面
     * @return [type] [description]
     */
    public function records()
    {   
        $this->view->desc = '投诉记录' ;
        $where = $config = [] ;
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
        $data = parent::model()->getPaginateByTime($where,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 删除一条处罚记录
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

    /**
     * 修改处罚记录状态
     */
    public function setStauts(){
        if($this->request->isPost()){
            $data = $this->request->post();
            $res = parent::model()->setStatus(1,['id'=>$data['id']]);
            if($res){
                return ['code'=>1,'msg'=>'修改成功'];
            }else{
                return ['code'=>0,'msg'=>'修改失败'];
            }
        }
    }

}