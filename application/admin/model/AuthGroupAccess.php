<?php
namespace app\admin\model;

class AuthGroupAccess extends Base
{

    //超级管理员权限
    const ADMIN_RULE = "2,4,5,6,7,8,9,10,11";
/**
 * 用户组分配
 * @param  string $uid    用户ID
 * @param  array  $groups 用户组 ID
 * @return null
 */
    public function editAuthGroupAccess($uid, array $groups)
    {
        $_exists = $this->where('uid', $uid)->column('group_id');
        if (!empty($_exists)) {
            $new    = array_diff($groups, $_exists); // 新增的字段
            $delete = array_diff($_exists, $groups); // 应删除的字段 
        } else {
            $new = $groups;
            $delete = [];
        }
        if (!empty($delete)) {
            $this->where(['uid'=>$uid, 'group_id'=>['in', $delete]])->delete();
        }
        $save = [];
        foreach ($new as $group) {
            $save[] = ['uid'=>$uid, 'group_id'=>$group];
        }
        return $this->saveAll($save);
    }

    /**
     * 关联用户分组表
     * @return [type] [description]
     */
    public function authGroup(){
        return $this->belongsTo('AuthGroup','group_id','id')->field('id,rules');
    }

    /**
     * 查询自己的权限
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    public function rules($uid)
    {   
        if($uid==1){
            $data['auth_group']['rules']=self::ADMIN_RULE;
        }else{
            $data = self::with('authGroup')->where('uid',$uid)->find()->toArray();
        }
        return explode(',',$data['auth_group']['rules']);  
    }

}