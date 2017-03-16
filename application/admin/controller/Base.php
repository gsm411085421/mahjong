<?php
namespace app\admin\controller;

use app\common\controller\Base as Controller;
use think\Config;
use think\Session;
use think\response\Redirect;

class Base extends Controller
{
    protected $uid; // 用户 ID
    protected $header = 'Header';
    protected $desc   = 'desc';

    public function _initialize()
    {
        Session::init();
        $this->_checkLogin(); // 登录检查

        $this->view->config('tpl_cache', false); // 关闭模板缓存
        if ($this->request->isPjax()) {
            Config::set('default_ajax_return', 'html');
            $this->view->engine->layout(false);
        }
        $this->view->header = $this->header;
        $this->view->desc   = $this->desc;
    }
/**
 * 登录检查
 */
    private function _checkLogin()
    {
        $uid = Session::get(Config::get('session_name.uid'));
        if ($uid) {
            $this->uid = $uid;
        } else {
            $response = new Redirect('Login/index');
            $response->code(302);
            throw new \think\exception\HttpResponseException($response);
        }
    }

    /**
     * 图片上传
     * @return [type] string 图片保存路径
     */
    protected function uploadImg($name="image"){
        //验证图片 
        $file = $this->request->file($name);
        if(!$file->check(config('upload_img_rule'))){ 
            return ['code'=>0, 'msg'=>$file->getError()];
        }
        $info = $file->move(config('img_save_root'));
        if($info){
            $result = ['code'=>1, 'data'=>config('img_save_url').str_replace('\\', '/', $info->getSaveName())];
        }
        else{
            $result = ['code'=>0, 'msg'=>$info->getError()];
        }      
        return $result;
    }



}