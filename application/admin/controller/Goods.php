<?php  
namespace app\admin\controller;


class Goods extends Base
{

    protected $header = '商城管理'; 

    const PAGE_SIZE = 4 ;

    /**
     * 商品显示页面
     * @return [type] [description]
     */
    public function goodsManage()
    {
        $this->view->desc = '商品管理';
        $where = $config = [];
        if($this->request->isGet() && $this->request->has('query')){
            $get = $this->request->get();
            if(isset($get['status']) && $get['status'] != -1 ){
               $config['query']['status'] = $where['status'] = $get['status'];
            }
            if(isset($get['search']) && $get['search'] ){
                $where['name'] = ['like','%'.$get['search'].'%'];
                $config['query']['search'] = $get['search'];
            }
        }
        $data = parent::model()->getPaginateByTime($where,self::PAGE_SIZE,$config);
        return $this->fetch('', ['list' => $data]);
    }

    /**
     * 添加商品页面
     */
    public function addGoods()
    {   
        $this->view->desc = '添加商品';
        if($this->request->isPost()){
            $input = $this->request->post();
            return parent::model()->edit($input);
        }  
        return $this->fetch();
    }

    /**
     * 编辑商品页面
     */
    public function editGoods($id)
    {   
        $this->view->desc = '编辑商品';
        $data = parent::model()->getOne($id);
        if($this->request->isPost()){
            $data = $this->request->Post();
            return parent::model()->edit($data);    
        }
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 删除一条商品信息
     * @return [type] [description]
     */
    public function deleteGoods()
    {
        if($this->request->isPost()){
            $data = $this->request->Post();
            return parent::model()->deleteOne($data['id']);        
        }
    }

    
    /**
     * 切换商品状态
     * @return [type] [description]
     */
    public function changeStatus()
    {
        if($this->request->isPost()){
            $data = $this->request->Post();
            $res = parent::model()->setStatus($data['status'], ['id'=>$data['id']]);
            if ($res) {
                $handle = ['code'=>1,'msg'=>'修改成功'];
            } else {
                $handle = ['code'=>0,'msg'=>'修改失败'];
            }
            return $handle;
        }
    }


}