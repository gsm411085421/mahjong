<?php 
namespace app\admin\controller;

use app\common\api\SystemConfig;

class Notice extends Base
{
    protected $header = '公告管理';
    protected $desc   = '平台规则';

    /**
     * 平台规则
     * @return [type] [description]
     */
    public function regulation()
    {   
        $this->view->desc = '平台规则';
        $api  = new SystemConfig; 
        $data = $api -> data();
        return $this->fetch('',['data'=>$data]);
    }
    /**
     * 保存到配置文件里
     * @return [type] [description]
     */
    public function saveConfig()
    {
        $data = $this->request->post();
        dump($data);
        $api  = new SystemConfig;
        $api->update($data);
        return ['code'=>1, 'msg'=>'操作成功'];
    }
}
