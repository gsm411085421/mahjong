<?php 
namespace app\admin\model;

class Convert extends Base
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
     * 兑换列表分页
     * @param  array  $where    [description]
     * @param  [type] $pageSize [description]
     * @param  array  $config   [description]
     * @return [type]           [description]
     */
    public function getConvertList(array $where,$field=true,$pageSize=null,array $config)
    {
        return self::with('member')->where($where)->order('create_at desc')->field($field)->paginate($pageSize,false,$config);
    }

}