<?php 
namespace app\admin\controller;
use app\common\api\SystemConfig;

class System extends Base
{
 

    /*平台规则页面*/
    public function rule()
    {   
        $this->view->header = '公告管理';
        $this->view->desc = '平台规则';
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        return $this->fetch('',['list'=>$data]);
    }


    /*修改配置文件*/
    public function updateSystem()
    {
        if($this->request->isPost()){
            $input = $this->request->post();
            $systemConfig = new SystemConfig();
            $data = $systemConfig->update($input);
            if($data){
                return ['code'=>1,'msg'=>'修改成功'];
            }else{
                return ['code'=>0,'修改失败'];
            }
        }
    }

    /**
     * 业务配置页面
     * @return [type] [description]
     */
    public function system()
    {
        $this->view->header = '系统配置';
        $this->view->desc = '业务配置';
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 代理说明页面
     * @return [type] [description]
     */
    public function agencyDetail(){
        $this->view->header = '代理管理';
        $this->view->desc = '代理说明';
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        return $this->fetch('',['list'=>$data]);
    }


}