<?php  
namespace app\admin\controller;

class Statis extends Base{

    protected $header = '同座管理';

    const PAGE_SIZE = 7;

    public function statisList()
    {   
        $this->view->desc = '同座记录';
        $where = $config = [];
        $data = parent::model()->getPaginate($where,true,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }

}