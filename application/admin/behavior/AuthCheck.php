<?php
namespace app\admin\behavior;

use com\Auth;
use think\Session;
use think\Config;

class AuthCheck
{
    use \traits\controller\Jump;

    /**
     * 不验证的控制器
     * @var array
     */
    private static $exceptController = [
        'login'
    ];

    /**
     * 不验证的方法
     * @var array
     */
    private static $exceptAction = [
        'index/index',
    ];

    public function run(&$param)
    {
        $request = \think\Request::instance();
        $auth = new Auth;
        $controller = $request->controller();
        $action     = $request->action();

        $controller = strtolower($controller);
        $action     = strtolower($action);
        Session::init(); // session 初始化
        $sessionName = Config::get('session_name.uid');
        $uid = Session::get($sessionName);

        // 验证排除
        if ($uid == 1) return true; // 超级管理员不验证
        if (in_array($controller, self::$exceptController)) return true;
        if (in_array($controller.'/'.$action, self::$exceptAction)) return true;

        if (! $auth->check($controller.'/'.$action, $uid)) {
            $this->error('权限不足');
            exit();
        }
    }
}