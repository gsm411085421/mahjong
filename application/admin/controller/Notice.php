<?php  
namespace app\admin\controller;
use think\Loader;

class Notice extends Base
{

    protected $header = '公告管理'; 
    /**
     * 系统公告页面
     * @return [type] [description]
     */
    public function systemNotice(){
        $this->view->desc = '系统公告'; 
        $data = Loader::model('Notice')->showRule();
        return $this->fetch('', [
            'list' => $data ,
            ]);
    }

    /**
     * 活动管理页面
     * @return [type] [description]
     */
    public function active(){
        $this->view->desc = '活动公告';
        $data = Loader::model('Notice')->showActive();
        return $this->fetch('', [
            'activelist' => $data ,
            ]);
    }

    /**
     * 存入一条系统公告
     * @return [type] [description]
     */
    public function saveNotice(){
        if($this->request->isPost()){
            $input = $this->request->post();
            return Loader::model('Notice')->saveNotice($input);        
        }  
    }

    /**
     * 存入一条活动管理
     * @return [type] [description]
     */
    public function saveActive(){
        if($this->request->isPost()->isPost()){
            $input = $this->request->post();
            return Loader::model('Notice')->saveActive($input);        
        }  
    }


    /**
     * 删除一条系统公告
     * @return [type] [description]
     */
    public function deleteNotice(){
        if($this->request->isPost()){
            $data = $this->request->post();
            return Loader::model('Notice')->deleteNotice($data['id']);
        }  
    }

    /**
     * 删除一条活动管理
     * @return [type] [description]
     */
    public function deleteActive(){
        if($this->request->isPost()){
            $data = $this->request->post();
            return Loader::model('Notice')->deleteActive($data['id']);
        }  
    }

    /**
     * 修改系统公告信息
     * @return [type] [description]
     */
    public function changeNotice(){
        if($this->request->isPost()){
            $data = $this->request->post();
            return Loader::model('Notice')->changeNotice($data);
        }
    }

    /**
     * 修改活动管理信息
     * @return [type] [description]
     */
    public function changeActive(){
        if($this->request->isPost()){
            $data = $this->request->post();
            return Loader::model('Notice')->changeActive($data);
        }
    }

    /**
     * 修改公告状态
     * @return [type] [description]
     */
    public function changeStatus(){
        if($this->request->isPost()){
            $data = $this->request->post();
            return Loader::model('Notice')->changeStatus($data['id'],$data['status']);  
        }
    }


    public function rule(){
        return $this->fetch();
    }

}