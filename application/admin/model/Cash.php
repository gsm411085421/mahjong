<?php  
namespace app\admin\model;

class Cash extends Base
{
    public function showRecharge($page = 4)
    {
        return $this->field(true)->where('type',1)->paginate($page);
    }
}