<?php 
namespace app\admin\model;

class Cash extends Base
{
    /**
     * 充值或提现记录列表
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public function getCashs($type)
    {
        return self::getLists(['type'=>$type],true,$pageSize=7);
    }
}