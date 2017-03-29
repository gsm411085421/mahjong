<?php  
namespace app\admin\controller;

class Member extends Base
{   
    const PAGE_SIZE = 2;

    protected $header = '会员管理';

    /**
     * 会员中心页面
     * @return [type] [description]
     */
    public function member()
    {
        $this->view->desc = '会员中心';
        $where = $config = [];
        if($this->request->isGet() && $this->request->has('query')){
            $get = $this->request->get();
            if(isset($get['status']) && $get['status'] != -1){
                $config['query']['status']=$where['status']=$get['status'];
            }
            if(isset($get['search']) && $get['search']){
                $where['nickname|id'] = ['like', '%'.$get['search'].'%'];
                $config['query']['search']=$get['search'];
            }
        }
        $data = parent::model()->getPaginate($where,true,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 代理管理页面
     * @return [type] [description]
     */
    public function agency()
    {
        $this->view->desc = '代理管理';
        $where = $config = ['is_rank'=>1];
        if($this->request->isGet() && $this->request->has('query')){
            $get = $this->request->get();
            if(isset($get['status']) && $get['status'] != -1){
                $config['query']['status']=$where['status']=$get['status'];
            }
            if(isset($get['search']) && $get['search']){
                $where['nickname|id']=['like', '%'.$get['search'].'%'];
                $config['query']['search']=$get['search'];
            }
        }
        $data = parent::model()->getPaginate($where,true,self::PAGE_SIZE,$config);
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 充值或者扣钱
     * @return [type] [description]
     */
    public function updateCoin()
    {
        if($this->request->isPost()){
            $input = $this->request->post();
            return parent::model()->updateCoin($input);
        }
    }

    /**
     * 会员详细信息页面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function memberInfo($id)
    {   
        $this->view->desc = '个人信息' ;
        $data = parent::model()->showInfo($id);
        $member = parent::model()->getOne($id);
        $parent = parent::model()->showParent($member['pid']);
        return $this->fetch('',['list'=>$data,'parentInfo'=>$parent]);
    }

    /**代理详细信息页面
     * [agencyInfo description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function agencyInfo($id)
    {
        $this->view->desc = '代理信息' ;
        $data = parent::model()->showInfo($id);
        $childs = parent::model()->showChild($id);
        return $this->fetch('',['list'=>$data,'childs'=>$childs]);
    }

    /**
     * 改变会员状态并写入对应记录表
     * @return [type] [description]
     */
    public function changeStatus()
    {
        if($this->request->isPost()){
            $data = $this->request->post();
            return parent::model()->changeStatus($data);       
        }
    }

    /**
     * 删除一条会员信息
     * @return [type] [description]
     */
    public function deleteOne()
    {   
        if($this->request->isPost()){
            $data = $this->request->post();
            return parent::model()->deleteOne($data['id']);
        }   
    }

    
}