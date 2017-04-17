<?php 
namespace app\index\controller;

class MemberProfile extends Base
{   
    /**
     * 根据id查找一条信息
     * @return [type] [description]
     */
    public function findOne()
    {
        if($this->request->isPost()){
            return self::model()->findOne($this->uid);
        }     
    }

    /**
     * 修改个人信息
     * @return [type] [description]
     */
    public function update()
    {
        if($this->request->isPost()){
            $data = $this->request->post();
            $user = self::model()->findOne($this->uid);
            $data['id']=$user['data'];
            return  parent::model()->updateOne($data);
        }
    }
}