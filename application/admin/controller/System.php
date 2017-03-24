<?php 
namespace app\admin\controller;
use app\common\api\SystemConfig;
use think\Loader;

class System extends Base
{
    protected $header = "系统配置"; 
    

    /*平台规则页面*/
    public function rule()
    {   
        $this->view->desc = '平台规则';
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        return $this->fetch('',['list'=>$data]);
    }

    /*平台规则编辑页面*/
    public function editRule()
    {   
        $this->view->desc = '编辑平台规则';
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        return $this->fetch('',['list'=>$data]);
    }

    /*修改平台规则*/
    public function updateSystem()
    {
        if($this->request->isPost()){
            $input = $this->request->post();
            $systemConfig = new SystemConfig();
            $data = $systemConfig->saveUpdate($input);
            if($data){
                return ['code'=>1,'msg'=>'添加成功'];
            }else{
                return ['code'=>0,'添加失败'];
            }
        }
    }




}