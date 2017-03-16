<?php  
namespace app\admin\controller;

use think\Loader;

class WithdrawApply extends Base
{

    protected $header = '会员管理' ;

    /**
     * 提现管理页面
     * @return [type] [description]
     */
    public function withdrawApply()
    {   
        $this->view->desc = '提现管理' ;
        $data = Loader::model('WithdrawApply')->showWithdrawApply();
        return $this->fetch('',[
            'list'=>$data
            ]);
    }

    /**
     *  存入一条提现记录
     * @return [type] [description]
     */
    public function saveWithdraw()
    {
        if($this->request->ispost()){
            $data = $this->request->Post();
            return Loader::model('WithdrawApply')->saveWithdraw($data);
        }
    }

    /**
     * 删除一条充值记录
     * @return [type] [description]
     */
    public function deleteWithdraw()
    {
        if($this->request->ispost()){
            $data = $this->request->Post();
            return Loader::model('WithdrawApply')->deleteWithdraw($data['id']);
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
                $res = Loader::model('WithdrawApply')->changeUpdate($data['id']);
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