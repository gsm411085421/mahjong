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
   

}
