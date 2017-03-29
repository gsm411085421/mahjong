<?php  
namespace app\index\model;

class Notice extends Base
{   
    /**
     * 查询可用状态的公告
     * @return [type] [description]
     */
    public function showNotice()
    {
        return $this->where('status',1)->select();
    }

    /**
     * 查询系统公告
     * @return [type] [description]
     */
    public function showSystem()
    {
        return $this->where('type',0)->select();
    }

     /**
     * 查询活动公告
     * @return [type] [description]
     */
    public function showActive()
    {
        return $this->where('type',1)->select();
    }

     /**
     * 查询即时公告
     * @return [type] [description]
     */
    public function showNow()
    {
        return $this->where('type',2)->select();
    }



}