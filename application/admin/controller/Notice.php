<?php 
namespace app\admin\controller;
use think\Loader;

class Notice extends Base
{
    protected $header = '公告管理';
    /**
     * 公告列表
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public function noticeList($type)
    {
        if(!$type) {
            $file = 'system';
            $desc = '系统公告列表';
        } else {
            $file = 'active';
            $desc = '活动公告列表';
        } 
        $file .= 'List';
        $this->view->desc = $desc;
        $data = Loader::model('Notice')->getNotices($type);
        return $this->fetch($file, ['data' => $data]);
    }
    /**
     * 新增或修改公告
     * @return [type] [description]
     */
    public function saveNotice()
    {
        if($this->request->isPost()) {
            $data = $this->request->post();
            $data['admin_user'] = Loader::model('Admin')->getUser($this->uid);
            $res = Loader::model('Notice')->saveNotice($data);
            return $res;
        }
    }
    /**
     * 获取一条数据
     * @return [type] [description]
     */
    public function getOne()
    {
        $id = $this->request->post('id');
        return Loader::model('Notice')->getOne($id);
    }
    /**
     * 删除公告
     * @return [type] [description]
     */
    public function deleteNotice()
    {
        if($this->request->isPost()) {
            $id = $this->request->post('id');
            $res = Loader::model('Notice')->delOne($id);
            return $res;
        }
    }
    /**
     * 更改状态
     * @return [type] [description]
     */
    public function changeStatus()
    {
        if($this->request->isPost()) {
          $input = $this->request->post();
          $res = Loader::model('Notice')->setStatus($input['status'],['id'=>$input['id']]);
          return $res;
        }
    }
    /**
     * 系统公告
     * @return [type] [description]
     */
    // public function systemNotice(){
    //     $this->view->desc = '系统公告'; 
    //     $data = Loader::model('Notice')->showRule();
    //     return $this->fetch('', [
    //         'list' => $data ,
    //         ]);
    // }
    /**
     * 存入一条系统公告
     * @return [type] [description]
     */
    // public function saveNotice(){
    //     if($this->request->isPost()){
    //         $input = $this->request->post();
    //         return Loader::model('Notice')->saveNotice($input);        
    //     }  
    // }
    /**
     * 存入一条活动管理
     * @return [type] [description]
     */
    // public function saveActive(){
    //     if($this->request->isPost()->isPost()){
    //         $input = $this->request->post();
    //         return Loader::model('Notice')->saveActive($input);        
    //     }  
    // }
    /**
     * 删除一条系统公告
     * @return [type] [description]
     */
    // public function deleteNotice(){
    //     if($this->request->isPost()){
    //         $data = $this->request->post();
    //         return Loader::model('Notice')->deleteNotice($data['id']);
    //     }  
    // }

    /**
     * 删除一条活动管理
     * @return [type] [description]
     */
    // public function deleteActive(){
    //     if($this->request->isPost()){
    //         $data = $this->request->post();
    //         return Loader::model('Notice')->deleteActive($data['id']);
    //     }  
    // }
    /**
     * 修改系统公告信息
     * @return [type] [description]
     */
    // public function changeNotice(){
    //     if($this->request->isPost()){
    //         $data = $this->request->post();
    //         return Loader::model('Notice')->changeNotice($data);
    //     }
    // }

    /**
     * 修改活动管理信息
     * @return [type] [description]
     */
    // public function changeActive(){
    //     if($this->request->isPost()){
    //         $data = $this->request->post();
    //         return Loader::model('Notice')->changeActive($data);
    //     }
    // }

    /**
     * 修改公告状态
     * @return [type] [description]
     */
    // public function changeStatus(){
    //     if($this->request->isPost()){
    //         $data = $this->request->post();
    //         return Loader::model('Notice')->changeStatus($data['id'],$data['status']);  
    //     }
    // }
    // public function rule(){
    //     return $this->fetch();
    // }

}
