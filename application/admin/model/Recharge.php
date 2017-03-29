<?php  
namespace app\admin\model;

class Recharge extends Base
{
    /**
     * 关联会员表
     * @return [type] [description]
     */
    public function member()
    {
        return $this->belongsTo('Member','member_id','id')->field('id,nickname,head_img');
    }

    /**
     * 获取分页充值信息
     */
    public function getRechargeList(array $where,$field=true,$pageSize=null,array $config)
    {
        return self::with('member')->where($where)->order('create_at desc')->field($field)->paginate($pageSize, false, $config);
    }

}
