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
            if(isset($get['search']) && $get['search'] ){
                $where['member_id1'] = $where['member_id2'] = $where['member_id3'] = $where['member_id4'] = ['like','%'.$get['search'].'%'];
                $config['query']['search'] = $get['search'];
            }
        }
        $data = parent::model()->getPaginate($where,true,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 结算详情页面
     * @return [type] [description]
     */
    public function recordsDetail($member_id1,$member_id2,$member_id3,$member_id4)
    {   
        $this->view->desc = '结算详情' ;
        $member1 = parent::model()->findMember($member_id1);
        $member2 = parent::model()->findMember($member_id2);
        $member3 = parent::model()->findMember($member_id3);
        $member4 = parent::model()->findMember($member_id4);
        return $this->fetch('',[
            'member1'=>$member1,
            'member2'=>$member2,
            'member3'=>$member3,
            'member4'=>$member4
            ]);
    }


    /**
     * 手动结算
     * @return [type] [description]
     */
    public function settlement()
    {
        if($this->request->isPost()){
            $data = $this->request->post();
            $sum = $data['mi1_money']+$data['mi2_money']+$data['mi3_money']+$data['mi4_money'];
            if($sum==0){
                return parent::model()->settle($data);
            }    
        }
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