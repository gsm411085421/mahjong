<?php
namespace app\admin\model;

class AuthGroupAccess extends Base
{
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
}