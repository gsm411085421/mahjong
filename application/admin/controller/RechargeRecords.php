<?php  
namespace app\admin\controller;

use think\Loader;

class RechargeRecords extends Base
{

    protected $header = '会员管理';

    /**
     * 充值管理页面
     */
    public function rechargeRecords()
    {   
        $this->view->desc = '充值管理';
        $data = Loader::model('RechargeRecords')->showRecharge();
        return $this->fetch('',[
            'list'=>$data
            ]);
    }

    /**
     *  存入一条充值记录
     * @return [type] [description]
     */
    public function saveRecharge()
    {
        if($this->request->ispost()){
            $data = $this->request->Post();
            return Loader::model('RechargeRecords')->saveRecharge($data);
        }
    }

    /**
     * 删除一条充值记录
     * @return [type] [description]
     */
    public function deleteRecharge()
    {
        if($this->request->ispost()){
            $data = $this->request->Post();
            return Loader::model('RechargeRecords')->deleteRecharge($data['id']);
        }
    }

    /**
     * 修改充值订单状态并刷新更新时间
     * @return [type] [description]
     */
    public function changeStatus()
    {
        if($this->request->ispost()){
            $data = $this->request->Post();
            $res = parent::model()->setStatus($data['status'],['id'=>$data['id']]);
            if($res){
                $res = Loader::model('RechargeRecords')->changeUpdate($data['id']);
                if($res){
                    return ['code'=>1,'msg'=>'修改成功'];
                }else{
                    return ['code'=>0,'msg'=>'修改失败'];
                }   
            }else{
                return ['code'=>0,'msg'=>'修改失败'];
            }
        }
    }

}