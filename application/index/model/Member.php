<?php  
namespace app\index\model;

class Member extends Base
{   

    /**
     * 根据ID查找一条会员信息
     * @return [type] [description]
     */
    public function findOne($id)
    {
        return $this->where('id',$id)->find();
    }

    /**
     * 根据id查找下级
     * @param  [type] $pid [description]
     * @return [type]      [description]
     */
    public function findChilds($id)
    {
        return $this->where('pid',$id)->select();
    }

}