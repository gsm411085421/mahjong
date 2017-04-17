<?php

namespace app\index\controller;

use app\common\controller\Base as BaseController;
use think\Session;
use think\Url;
use EasyWeChat\Foundation\Application;

class Base extends BaseController
{
    /** string 用户信息全局变量名 */
    const GLOBAL_USERINFO = 'G_user';
    /** @var integer 用户ID */
    protected $uid = 100002;

    /** @var array 缓存用户信息 */
    protected $userInfo;

    /** @var Model instance  API 模型类实例 */
    protected $modelApi;

    /**
     * 当前模块名
     * @var string
     */
    protected $module = 'index';
    /**
     * 初始化
     */
    protected function _initialize()
    {
        parent::_initialize();

        Session::init();        
        // Session::clear();
        /*if (!$this->request->has('code') && !Session::has('userInfo')) { // 请求中不含 code 微信授权
            $config = [
                'oauth' => [
                    'callback' => $this->request->url()
                ],
            ];
            $config = array_merge($this->getWechatConfig(), $config);
            return (new Application($config))->oauth->redirect();
        }*/
        $this->wechatOauth();

        $this->modelApi = parent::model('Api');
        // 注入全局到视图
        $this->_assignGlobalUserInfo();
    }

    /**
     * 微信授权，用户信息写 属性、Session
     * @return 
     */
    protected function wechatOauth()
    {
        if (Session::has('userInfo') && !Session::get('userInfo')) {
            $this->userInfo = Session::get('userInfo');
        } else {
            /*$app = new Application($this->getWechatConfig());
            $user = $app->oauth->user();

            $userInfo = $user->toArray();
            $userInfo['openid'] = $user->getId();

            $userInfo = parent::model('Member')->login($userInfo);*/
            $userInfo = parent::model('Member')->getOne($this->uid);
            $userInfo = $userInfo->toArray();
            Session::set('userInfo', $userInfo);
            $this->userInfo = $userInfo;
        }
        $this->uid = $this->userInfo['id'];
    }

    /**
     * 加载微信配置
     * @return array
     */
    protected function getWechatConfig()
    {
        $file = ROOT_PATH. 'application'. DS. 'index'. DS. 'wechat.php';
        return require($file);
    }

    /**
     * 刷新用户信息Session
     * @return [type] [description]
     */
    protected function refreshUserSession()
    {
        $curInfo  = parent::model('Member')->getOne($this->uid);
        Session::set('userInfo', array_merge($this->userInfo, $curInfo->toArray()));
        $this->userInfo = Session::get('userInfo');
    }

    /**
     * 用户信息注入全局
     * @return
     */
    private function _assignGlobalUserInfo()
    {
        $globalUserInfo = [
            'is_agent'     => 0, // 是否为代理
            'clear_status' => 1, // 是否已结算，未结算状态的玩家，不允许进行任何操作 ***
        ];
        $this->userInfo = array_merge($this->userInfo, $globalUserInfo);
        $this->view->assign(self::GLOBAL_USERINFO, $this->userInfo);
    }
}