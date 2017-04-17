<?php  
namespace app\admin\Controller;

class LandlordsRooms extends Base
{
    protected $header = '房间管理';

    const PAGE_SIZE = 4 ;

    public function roomList()
    {   
        $this->view->desc = '斗地主房间' ;
        $where = ['status'=>1];
        $config = [] ;
        if($this->request->isGet() && $this->request->has('query')){
            $get = $this->request->get();
            if(isset($get['search']) && $get['search'] ){
                $where['room_member_id|room_num'] = ['like','%'.$get['search'].'%'];
                $config['query']['search'] = $get['search'];
            }
        }
        $data = parent::model()->getPaginate($where,true,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }

    public function setStatus()
    {
        if($this->request->isPost()){
            $data = $this->request->post();
            $data['room_member_id']=$data['type1']=$data['type2']=$data['type3']=$data['type4']=$data['type5']=$data['type6']=$data['type7']=$data['room_num']=$data['low_times']=$data['member_id1']=$data['member_id2']=$data['member_id3']=$data['update_at']=$data['status']=0;
            return  parent::model()->edit($data);
        }
    }
}