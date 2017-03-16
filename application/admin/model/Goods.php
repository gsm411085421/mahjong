<?php 
namespace app\admin\model;
use think\Model;

class Goods extends Model{

    /**
     * 根据主键删除一条商品信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteGoods($id){
        $res = $this->where('id', $id)->delete();
        if($res){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>0,'msg'=>'删除失败'];
        } 
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
    public function saveGoods(array $input){
        $handle = $this->allowField(true)->isUpdate(false)->validate(true)->save($input);
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
        $res = $this->allowField(true)->isUpdate(true)->validate(true)->save($data);
        if($res){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>'修改失败'];
        }   
    }

    /**
     * 切换商品状态
     * @param  [type] $id     商品主键id
     * @param  [type] $status 商品状态值
     * @return [type]         [description]
     */
    public function changeStatus($id,$status){
        $res = $this->isUpdate(true)->save(['id'=>$id,'status'=>$status]);
        if($res){
                return ['code'=>1,'msg'=>'修改成功'];
        }else{
                return ['code'=>0,'msg'=>'修改失败'];
        } 
    }


 }