<?php 
namespace app\admin\controller;
use app\common\api\SystemConfig;
use think\Loader;

class System extends Base
{
    protected $header = "系统配置"; 
    
    public function index()
    {
        return $this->fetch();
    }
}