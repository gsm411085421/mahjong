<?php  
namespace app\index\model;

class MemberProfile extends Base
{
    /**
     * 根据用户ID查询用户详情
     * @return [type] [description]
     */
    public function findOne($member_id){
        return $this->where('member_id',$member_id)->find()->toArray();
    }

    

}