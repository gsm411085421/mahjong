<?php  
namespace app\index\model;

class MemberGameRecords extends Base
{   
    /**
     * 根据用户ID查找用户得分记录表
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function findOne($member_id)
    {
        return $this->where('member_id',$member_id)->select();
    }
}