<?php  
namespace app\admin\controller;

class PandaRooms extends Base
{   
    const PAGE_SIZE = 2 ;

    protected $header = '房间管理';


    /**
     * 熊猫麻将房间页面
     * @return [type] [description]
     */
    public function roomList()  
    {   
        $this->view->desc = '熊猫麻将';
        $where = $config = [];
        if($this->request->isGet() && $this->request->has('query') ){
            $get = $this->request->get();
            if(isset($get['status']) && $get['status'] != -1){
                $where['status'] = $config['query']['status'] = $get['status'];
            }
            if(isset($get['search']) && $get['search'] ){
                $where['room_member_id'] = ['like','%'.$get['search'].'%'];
                $config['query']['search'] = $get['search'];
            }
        }
        $data = parent::model()->getPaginate($where,true,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }


    /**
     * 设置房间状态
     */
    public function setStatus()
    {
        if($this->request->isPost()){
            $input = $this->request->post();
            $res = parent::model()->setStatus($input['status'],['id'=>$input['id']]);
            if ($res) {
                $handle = ['code'=>1,'msg'=>'修改成功'];
            } else {
                $handle = ['code'=>0,'msg'=>'修改失败'];
            }
            return $handle;
        }
    }


     /**
     * 删除一条熊猫麻将信息
     * @return [type] [description]
     */
    public function deleteOne()
    {   
        if($this->request->isPost()){
            $data = $this->request->post();
            return parent::model()->deleteOne($data['id']);
        }   
    }



}