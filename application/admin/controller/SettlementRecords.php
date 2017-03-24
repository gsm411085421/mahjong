<?php  
namespace app\admin\controller;

class SettlementRecords extends Base
{   
    protected $header = '结算管理' ;

    const PAGE_SIZE = 2 ;

    /**
     * 结算记录页面
     * @return [type] [description]
     */
    public function records()
    {   
        $this->view->desc = '结算记录' ;
        $where = $config = [];
        if($this->request->isGet() && $this->request->has('query') ){
            $get = $this->request->get();
            if(isset($get['status']) && $get['status'] != -1 ){
                $where['status'] = $config['query']['status'] = $get['status'];
            }
        }
        $data = parent::model()->getPaginate($where,true,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 删除一条结算记录
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