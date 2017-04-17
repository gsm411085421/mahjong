<?php
namespace app\admin\controller;

use app\common\controller\Base as Controller;
use think\Config;
use think\Session;
use think\Loader;
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
        //菜单数据、用户个人信息注入全局
        $this->_assignGlobalInfo();

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
     * 菜单信息、用户个人信息注入全局
     * @return
     */
    private function _assignGlobalInfo()
    {   
        //获取session中的用户id
        $uid = Session::get(Config::get('session_name.uid'));
        //根据用户id查询自己的权限
        $ids = Loader::model('AuthGroupAccess')->rules($uid);
        //返回权限菜单
        $data = Loader::model('AuthRule')->menu($ids);
        //根据id查询个人信息
        $admin = Loader::model('Admin')->getAdminDetail($uid);
        $this->view->assign('menu', $data);
        $this->view->assign('admin', $admin);
    }


}