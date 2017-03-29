<?php 
namespace app\admin\controller;

class Notice extends Base
{
    protected $header = '公告管理';

    const PAGE_SIZE = 4 ;
    /**
     * 公告列表
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public function notice()
    {   
        $this->view->desc = '公告管理' ;
        $where = $config = [];
        if($this->request->isGet() && $this->request->has('query') ){
            $get = $this->request->get();
            if(isset($get['type']) && $get['type'] != -1 ){
                $where['type'] = $config['query']['type'] = $get['type'];
            }
            if(isset($get['status']) && $get['status'] != -1 ){
                $where['status'] = $config['query']['status'] = $get['status'];
            }
            if(isset($get['search']) && $get['search'] ){
                $where['title'] = ['like','%'.$get['search'].'%'];
                $config['query']['search'] = $get['search'];
            }
        }
        $data = parent::model()->getPaginateByTime($where,self::PAGE_SIZE,$config);
        return $this->fetch('',['data'=>$data]);
    }


    /**
     * 添加公告页面
     * @return [type] [description]
     */
    public function saveNotice()
    {   
        $this->view->desc = '添加公告';
        return $this->fetch();
    }


    /**
     * 添加或跟新公告
     */
    public function addNotice()
    {
        if($this->request->isPost()){
            $input = $this->request->post();
            return parent::model()->saveNotice($input);
        }
    }
 
    /**
     * 编辑公告页面
     * @return [type] [description]
     */
    public function editNotice($id)
    {
        $this->view->desc = '编辑公告';
        $data = parent::model()->getOne($id);
        return $this->fetch('',['list'=>$data]);
    }


    /**
     * 删除一条公告
     * @return [type] [description]
     */
    public function deleteOne()
    {
        if($this->request->isPost()){
            $data = $this->request->post();
            return parent::model()->delOne($data['id']);
        }
    }

    /**
     * 设置公告状态
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

}
