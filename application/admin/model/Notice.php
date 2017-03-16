<?php 
namespace app\admin\model;

use think\Model;

class Notice extends Base
{

    /**
     * 分页显示系统公告
     * @param  integer $page 页数
     * @return [type]        [description]
     */
    public function showRule($page = 5,$type = 0){
       return $this->where('type',$type)->paginate($page);
    }

     /**
     * 分页显示活动管理
     * @param  integer $page 页数
     * @return [type]        [description]
     */
    public function showActive($page = 5,$type = 1){
       return $this->where('type',$type)->paginate($page);
    }


    /**
     * 存入一条系统公告
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    public function saveNotice(array $input){
        $input['type'] = 0 ;
        $handle = $this->allowField(true)->validate(true)->isUpdate(false)->save($input);
        if ($handle) {
            return ['code'=>1, 'msg'=>'添加成功', 'data'=>['id'=>$this->id]];
        }else{
            return ['code'=>0, 'msg'=>$this->getError()??'添加失败'];
        }
    }

    /**
     * 存入一条活动公告
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    public function saveActive(array $input){
        $input['type'] = 1 ;
        $handle = $this->allowField(true)->validate(true)->isUpdate(false)->save($input);
        if ($handle) {
            return ['code'=>1, 'msg'=>'添加成功', 'data'=>['id'=>$this->id]];
        }else{
            return ['code'=>0, 'msg'=>$this->getError()??'添加失败'];
        }
    }

    /**
     * 根据主键删除一条公告
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteNotice($id){
        return parent::deleteOne($id);
    }



    /**
     * 根据主键修改公告信息
     * @return [type] [description]
     */
    public function changeNotice(array $data){
        $res = $this->allowField(true)->validate(true)->isUpdate(true)->save($data);
        if($res){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>$this->getError()??'修改失败'];
        } 
    }



    /**
     * 根据主键修改公告状态
     * @param  [type] $id     [description]
     * @param  [type] $status [description]
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