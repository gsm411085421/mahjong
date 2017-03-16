<?php  
namespace app\admin\controller;

use think\Loader;

class Goods extends Base
{

    protected $header = '商城管理'; 
    /**
     * 商品显示页面
     * @return [type] [description]
     */
    public function goodsManage()
    {
        $this->view->desc = '商品管理';
        $data = Loader::model('Goods')->showGoods();
        return $this->fetch('', [
            'list' => $data,
        ]);
    }

    /**
     * 存入一条商品信息
     * @return [type] [description]
     */
    public function saveGoods()
    {
        if($this->request->isPost()){
            $input = $this->request->post();
            return Loader::model('Goods')->saveGoods($input);
        }  
    }

    /**
     * 删除一条商品信息
     * @return [type] [description]
     */
    public function deleteGoods()
    {
        if($this->request->isPost()){
            $data = $this->request->Post();
            return Loader::model('Goods')->deleteGoods($data['id']);        
        }
    }

    /**
     * 修改商品信息
     * @return [type] [description]
     */
    public function changeGoods()
    {
        if($this->request->isPost()){
            $data = $this->request->Post();
            return Loader::model('Goods')->changeGoods($data);    
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

    /**
     * 商品图片上传
     * @return [type] [description]
     */
    public function upload()
    {
        return parent::uploadImg();
    }



}