<?php
namespace app\admin\model;

use app\common\model\Base as Model;

class Base extends Model
{
    const PAGE_SIZE = 20;

/**
 * paginate 分页查询
 * @param  array   $where
 * @param  boolean $field
 * @param  int  $pageSize 
 * @return Collection
 */
    public function getLists($where=[], $field=true, $pageSize=null)
    {
        $pageSize === null and $pageSize = self::PAGE_SIZE;
        return $this->where($where)->field(true)->paginate($pageSize);
    }
/**
 * limit 分页查询
 * @param  integer $page     页码
 * @param  array   $where
 * @param  boolean $field
 * @param  int  $pageSize
 * @return array
 */
    public function getListsByLimit($page=1, $where=[], $field=true, $pageSize=null)
    {
        $pageSize === null and $pageSize = self::PAGE_SIZE;
        return $this->where($where)->field($field)->limit($pageSize)->page($page)->select();
    }
}