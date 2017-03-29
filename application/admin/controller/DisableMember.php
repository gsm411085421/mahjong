<?php  
namespace app\admin\controller;


class DisableMember extends Base
{   

    protected $header = '结算记录';

    const PAGE_SIZE = 7 ;

    public function disableMemberList()
    {   
        $this->view->desc = '封号记录';
        $where = $config = [];
        $data = parent::model()->getDisableMemberList($where,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }
}