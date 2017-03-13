<?php 
namespace app\admin\model;
use think\Model;
use think\helper\hash\Md5;
class Admin extends Model
{
/**
 * 登录检测
 * @param  [type] $user     [description]
 * @param  [type] $password [description]
 * @param  [type] $ip       [description]
 * @return [type]           [description]
 */
    public function login($user, $password, $ip)
    {
        $info = $this->field(true)->where('name',$user)->find();
        if ($info) {
            $md5 = new Md5;
            if ($md5->check($password,$info['password'])) {
                if ($info['status']) {
                    unset($info['password']);
                    //更新管理员表
                    self::_updateAdmin($info['id'],$info['login_times'],$ip);
                    $res = ['code'=>1, 'msg'=>'登录成功', 'data'=>['info'=>$info->toArray()]];
                } else {
                    $res = ['code'=>0, 'msg'=>'该账号已经被禁用'];
                }
            } else {
                $res = ['code'=>0, 'msg'=>'密码错误'];
            }
        } else {
            $res = ['code'=>0, 'msg'=>'账号不存在'];  
        } 
        return $res;
    }
/**
 * 更新管理员信息
 * @param  [type] $lastTime   [description]
 * @param  [type] $loginTimes [description]
 * @param  [type] $lastIp     [description]
 * @return [type]             [description]
 */
    private function _updateAdmin($id,$loginTimes,$ip)
    {
        $insertData = [
            'last_login_time' => date('Y-m-d H:i:s'),
            'last_login_ip'   => $ip,
            'login_times'     => ++$loginTimes
        ];
        return $this->save($insertData,['id'=>$id]);
    }
}