<?php
/**
 * 个人游戏结算记录
 */

namespace app\index\model;

class Settlement extends Base
{
    public static $pageSize = 20;

    public function getRecords($uid, $page=1)
    {
        $where = ['member_id'=>$uid];
        return $this->where($where)->order('create_at desc')->field(true)->limit(self::$pageSize)->page($page)->select();
    }
}