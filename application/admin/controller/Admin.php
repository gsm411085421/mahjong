<?php 
namespace app\admin\Controller;

class Admin extends Base
{
/**
 * 管理员个人中心
 * @return [type] [description]
 */
   public function index()
   {
        $this->fetch();
   }
}