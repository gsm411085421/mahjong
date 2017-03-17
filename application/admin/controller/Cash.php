<?php  
namespace app\admin\controller;

use think\Loader;

class Cash extends Base
{
    public function recharge()
    {   
        $data = Loader::model('Cash')->showRecharge();
        return $this->fetch('',[
            'list'=>$data,
            ]);
    }
}