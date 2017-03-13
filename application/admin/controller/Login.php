<?php 
namespace app\admin\controller;
use think\Controller;
use think\Loader;
use think\helper\hash\Md5;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
/**
 * ��¼
 * @return [type] [description]
 */
    public function login()
    {
        if ($this->request->isPost()) {
            $info = $this->request->post();
            if (session('__token__') === $info['__token__']) {
                $res = Loader::model('Admin')->login($info['name'], $info['password'], $this->request->ip());    
            } else {
                $res = ['code'=>0, 'msg'=>'�Ƿ��ύ'];
            } 
        } else {
            $res = ['code'=>0, 'msg'=> '�Ƿ�����'];
        }
        if ($res['code'])session('admin_user',$res['data']['info']); 
        return $res;
    }
/**
 * �˳�
 * @return [type] [description]
 */
    public function logout()
    {
      session('admin_user',null);
      $this->redirect('login/index');
    }
}