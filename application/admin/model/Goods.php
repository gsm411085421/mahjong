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
        $handle = $this->allowField(true)->validate(true)->isUpdate(false)->save($input);
        if ($handle) {
            return ['code'=>1, 'msg'=>'添加成功', 'data'=>['id'=>$this->id]];
        }else{
            return ['code'=>0, 'msg'=>$this->getError()? $this->getError() :'添加失败'];
        }
    }

    /**
     * 根据主键id修改一条商品信息
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function changeGoods(array $data){
        $res = $this->allowField(true)->validate(true)->isUpdate(true)->save($data);
        if($res){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>$this->getError()??'添加失败'];
        }   
    }


 }