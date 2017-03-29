<?php  
namespace app\admin\model;

class DisableMember extends Base
{

    /**
     * 关联用户表
     * @return [type] [description]
     */
    public function member()
    {
        return $this->belongsTo('Member','member_id','id')->field('id,nickname,head_img');
    }   

    public function getDisableMemberList(array $where,$pageSize,array $config)
    {
        return self::with('member')->where($where)->order('create_at desc')->paginate($pageSize,false,$config);
    }

}