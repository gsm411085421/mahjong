<?php
namespace app\index\controller;

use think\Loader;

class Index extends Base
{
    public function index()
    {
        $data = Loader::model('Member')->findChilds(100001);
        dump($data);die;
        return $this->fetch();
    }




}
