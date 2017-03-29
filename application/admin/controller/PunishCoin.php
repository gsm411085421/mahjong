<?php  
namespace app\admin\controller;


class PunishCoin extends Base
{   

    protected $header = '结算管理';

    const PAGE_SIZE = 7 ;

    public function punishList()
    {   
        $this->view->desc = '处罚记录';
        $where = $config = [];
        $data = parent::model()->getPaginateList($where,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }

}