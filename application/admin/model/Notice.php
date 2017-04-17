<?php 
namespace app\admin\model;

class Notice extends Base
{

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
  

}