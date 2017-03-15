<?php 
namespace app\admin\model;
use think\Model;

class Notice extends Model{

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
        $handle = $this->allowField(true)->isUpdate(false)->save($input);
        if ($handle) {
            return ['code'=>1, 'msg'=>'添加成功', 'data'=>['id'=>$this->id]];
        }else{
            return ['code'=>0, 'msg'=>'添加失败'];
        }
    }

    /**
     * 存入一条活动管理
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    public function saveActive(array $input){
        $input['type'] = 1 ;
        $handle = $this->allowField(true)->isUpdate(false)->save($input);
        if ($handle) {
            return ['code'=>1, 'msg'=>'添加成功', 'data'=>['id'=>$this->id]];
        }else{
            return ['code'=>0, 'msg'=>'添加失败'];
        }
    }

    /**
     * 根据主键删除一条系统公告
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteNotice($id){
        $res = $this->where('id',$id)->delete();
        if($res){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>0,'msg'=>'删除失败'];
        }
    }

     /**
     * 根据主键删除一条活动管理
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteActive($id){
        $res = $this->where('id',$id)->delete();
        if($res){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>0,'msg'=>'删除失败'];
        }
    }

    /**
     * 根据主键修改系统公告信息
     * @return [type] [description]
     */
    public function changeNotice(array $data){
        $res = $this->allowField(true)->isUpdate(true)->save($data);
        if($res){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>'修改失败'];
        } 
    }

    /**
     * 根据主键修改活动管理信息
     * @return [type] [description]
     */
    public function changeActive(array $data){
        $res = $this->allowField(true)->isUpdate(true)->save($data);
        if($res){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>'修改失败'];
        } 
    }

    /**
     * 根据主键修改状态
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