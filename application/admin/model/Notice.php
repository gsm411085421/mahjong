<?php 
namespace app\admin\model;

class Notice extends Base
{
    /**
     * 公告数据
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public function getNotices($type)
    {
        return self::getLists(['type'=>$type],true,$pageSize = 8);
    }
    /**
     * 新增或更改公告
     * @param  array  $input [description]
     * @return [type]        [description]
     */
    public function saveNotice(array $input)
    {
        if(empty($input['id'])) {
            $handle = $this->validate(true)->isUpdate(false)->save($input);
        } else {
            $input['create_at'] = date('Y-m-d H:i:s'); 
            $handle  = $this->validate(true)->isUpdate(true)->save($input);
        }
        if($handle) {
            return ['code'=>1, 'msg'=>'操作成功'];
        } else {
            return ['code'=>0, 'msg'=>$this->getError() ? $this->getError() : '操作失败'];
        }
    }
    /**
     * 删除一条数据
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delOne($id)
    {
        $handle = $this->where('id',$id)->delete();
        if($handle) {
            $res = ['code'=>1, 'msg'=>'删除成功'];
        } else {
            $res = ['code'=>0, 'msg'=>'删除失败'];
        }
        return $res;
    }
  

}