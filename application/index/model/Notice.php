<?php
namespace app\index\model;
use app\common\api\SystemConfig;

class Notice extends Base
{
    public static $fieldType = [0=>'系统公告', 1=>'活动公告', 2=>'即时公告'];

    /**
     * 获取即时公告
     * @return [type] [description]
     */
    public function getRealTimeNotice()
    {
        $where = ['status'=>1, 'type'=>2];
        return $this->where($where)->column('content');
    }

    /**
     * 获取系统公告
     */
    public function getAnnouncement()
    {
        $where = ['status'=>1,'type'=>0];
        return $this->where($where)->column('content');
    }

    /**
     * 获取平台规则
     * @return [type] [description]
     */
     public function getRule()
    {
        $systemConfig = new SystemConfig(); 
        $data = $systemConfig->data();
        return $data['rule'];
    }
    

}