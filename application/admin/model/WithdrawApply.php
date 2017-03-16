<?php  
namespace app\admin\model;

class WithdrawApply extends Base
{

    /**
     *  分页显示提现
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function showWithdrawApply($page = 4)
    {
        return $this->field(true)->paginate($page);
    }

    /**
     *  存入一条提现记录
     * @return [type] [description]
     */
    public function saveWithdraw(array $input)
    {
        $handle = $this->allowField(true)->validate(true)->isUpdate(false)->save($input);
        if($handle){
            return ['code'=>1,'msg'=>'添加成功','data'=>['id'=>$this->id]];
        }else{
            return ['code'=>0,'msg'=>$this->getError()??'添加失败'];
        }
    }


    /**
     * 删除一条充值记录
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteWithdraw($id)
    {
        return parent::deleteOne($id);
    }


    /**
     * 订单处理后更新时间
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function changeUpdate($id)
    {   
        return parent::changeUpdate($id);
    }

}