<?php
namespace app\admin\controller;
use think\Session;
use think\Loader;
use think\Config;
use think\Controller;

class Login extends Controller
{
    private static $_token_name = 'flash_login_token';

    public function _initialize()
    {
        Session::init();
    }

    public function index()
    {
        //初始化管理员表
        // $initAdmin = new \app\admin\modeldata\Admin;
        // $initAdmin->run();
        $token = md5($this->request->server('REQUEST_TIME_FLOAT'));
        Session::set(self::$_token_name, $token);
        $error = Session::pull('login_error');
        return $this->fetch('', ['token'=>$token, 'error'=>$error]);
    }

    public function login()
    {
        $input = $this->request->post();
        // token 验证
        if (!isset($input['__token__']) || ($input['__token__'] !== Session::pull(self::$_token_name))) {
            Session::flash('login_error', '非法请求');
            $this->redirect('Login/index');
        } else {
            $check = Loader::model('admin')->loginCheck($input['user'], $input['password'], $this->request->ip(true));
            if ($check['code']) {
                $info = $check['data']['info'];
                Session::set(Config::get('session_name.uid'), $info['id']);
                unset($info['id']);
                $info['login_times'] = intval($info['login_times']) + 1;
                Session::set(Config::get('session_name.uinfo'), $info);
                $this->redirect('Index/index');
            } else {
                Session::flash('login_error', $check['data']['msg']);
                $this->redirect('index');
            }
        }

    }

    public function logout()
    {
        Session::destroy();
        $this->redirect('Login/index');
    }
}