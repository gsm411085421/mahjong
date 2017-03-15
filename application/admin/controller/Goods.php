<?php  
namespace app\admin\controller;
use think\Loader;
use think\Request;

class Goods extends Base
{

    protected $header = '商城管理'; 
    /**
     * 商品显示页面
     * @return [type] [description]
     */
    public function goodsManage(){
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
    public function saveGoods(){
        $req = Request::instance();
        if($req->isPost()){
            $input = $req->post();
            return Loader::model('Goods')->saveGoods($input);
        }  
    }

    /**
     * 删除一条商品信息
     * @return [type] [description]
     */
    public function deleteGoods(){
        $req = Request::instance();
        if($req->isPost()){
            $data = $req->post();
            return Loader::model('Goods')->deleteGoods($data['id']);        
        }
    }

    /**
     * 修改商品信息
     * @return [type] [description]
     */
    public function changeGoods(){
        $req = Request::instance();
        if($req->isPost()){
            $data = $req->post();
            return Loader::model('Goods')->changeGoods($data);    
        }
    }
    
    /**
     * 切换商品状态
     * @return [type] [description]
     */
    public function changeStatus(){
        $req = Request::instance();
        if($req->isPost()){
            $data = $req->post();
            return Loader::model('Goods')->changeStatus($data['id'],$data['status']);
        }
    }

    /**
     * 商品图片上传
     * @return [type] [description]
     */
    public function upload(){
        return parent::uploadImg();
    }

}