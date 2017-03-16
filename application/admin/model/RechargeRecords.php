<?php  
namespace app\admin\model;

class RechargeRecords extends Base
{

    /**
     * 分页显示充值记录
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function showRecharge($page = 4)
    {
        return $this->field(true)->paginate($page);
    }

    /**
     *  存入一条充值记录
     * @return [type] [description]
     */
    public function saveRecharge(array $input)
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
    public function deleteRecharge($id)
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