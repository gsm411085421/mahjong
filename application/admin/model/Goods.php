<?php 
namespace app\admin\model;

class Goods extends Base
{

    /**
     * 根据主键删除一条商品信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteGoods($id)
    {
        return parent::deleteOne($id);    
    }

    /**
     * 查找一条商品信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function findOne($id)
    {
        return parent::getOne($id);
    }

    /**
     * 分页显示商品
     * @param  integer $page 页数
     * @return [type]        [description]
     */
    public function showGoods($page = 4){
        return $this->field(true)->paginate($page);
    }

       /**
     * 存入一条商品信息
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    public function saveGoods(array $input)
    {
        $res = $this->validate(true)->allowField(true)->isUpdate(false)->save($input);
        if($res){
            return ['code'=>1,'msg'=>'添加成功',['data'=>$this->id]];
        }else{
            return ['code'=>0,'msg'=>$this->getError()??'添加失败'];
        }
    }

    /**
     * 根据主键id修改一条商品信息
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function changeGoods($id)
    {
        $res = $this->validate(true)->allowField(true)->isUpdate(true)->save($id);
        if($res){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>$this->getError()??'修改失败'];
        }
    }


 }