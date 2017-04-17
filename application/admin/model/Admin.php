<?php
namespace app\admin\model;
use think\Db;
use think\helper\Hash;
use traits\model\SoftDelete;

use app\admin\model\AuthGroupAccess;

class Admin extends Base
{
    use SoftDelete;
    // 隐藏密码字段的查询
    protected $hidden = ['password'];

    public function authGroupAccess()
    {
        return $this->hasMany('AuthGroupAccess', 'uid', 'id')->field('uid,group_id');
    }
/**
 * 密码加密
 * @param [type] $value [description]
 */
    public function setPasswordAttr($value)
    {
        return Hash::make($value,'md5');
    }
/**
 * ip 转换
 * @param  int $value
 * @return string
 */
    public function getLastLoginIpAttr($value)
    {
        return long2ip($value);
    }

    /**
     * 软删除
     * @param [type] $id [description]
     */
    public function setDelete($id)
    {
        $this->save(['status'=>0], ['id'=>$id]);
        return self::destroy($id);
    }
/**
 * 查询详情
 * @param  string  $id
 * @param  boolean $field
 * @return Collection
 */
    public function getOne($id, $field=true)
    {
        $detail = self::with('AuthGroupAccess')->where('id', $id)->field(true)->find();
        $detail['groups'] = array_map(function($v){
            return $v['group_id'];
        }, $detail['auth_group_access']);
        return $detail;
    }
/**
 * 查询全部
 * @param  array  $where
 * @return array
 */
    public function getAll(array $where = [])
    {
        $info = self::with('authGroupAccess')->where($where)->field(true)->select();
        $authGroup = Db::name('AuthGroup')->column('title', 'id');
        array_walk($info, function(&$v) use($authGroup){
            $v['groups'] = array_map(function($item){
                return $item['group_id'];
            }, $v['auth_group_access']);
            $v['groups_text'] = array_map(function($item) use($authGroup){
                return $authGroup[$item['group_id']];
            }, $v['auth_group_access']);
        });
        return $info;
    }
/**
 * 编辑用户信息
 * @param  array  $input    表单数据
 * @param  boolean $fileInfo 上传文件信息
 * @return std
 */
    public function editUser($input, $fileInfo=false)
    {
        if ($fileInfo) {
            $input['headimg'] = $fileInfo['savename'];
        }
        $input['status'] = isset($input['status']) ? $input['status'] : 0;
        if (!$input['password'] && !$input['password_confirm']) {
            unset($input['password']);
            unset($input['password_confirm']);
        }
        $isUpdate = isset($input['id'])&&$input['id'] ? true : false;
        if ($isUpdate) {
            $handle = $this->validate('Admin.edit')->allowField(true)->isUpdate(true)->save($input);
        } else {
            $handle = $this->validate(true)->allowField(true)->isUpdate(false)->save($input);
        }
        if (isset($input['groups']) && !empty($input['groups']) && (false !== $handle)) {// 用户组
            $uid = $isUpdate ? $input['id'] : $this->id;
            $authGroupAccess = new AuthGroupAccess;
            $authGroupAccess->editAuthGroupAccess($uid, $input['groups']);
        }

        return $handle!==false ? ['code'=>1, 'msg'=>'操作成功'] : ['code'=>0, 'msg'=>$this->getError()?:'操作失败'];
    }
/**
 * 登录检查
 * @param  string $user
 * @param  string $password 
 * @param  int $ip       ip2long 转换后的整形无符号
 * @return array
 */
    public function loginCheck($user, $password, $ip)
    {
        $info = $this->visible(['password'])->field(true)->where('user', $user)->find();
        if ($info) {
            if (Hash::check($password, $info['password'], 'md5')) {// 密码验证通过
                if ($info['status'] == 1) { // 可用状态
                    unset($info['password']);
                    $this->_loginUpdate($info['id'], $info['login_times'], $ip);
                    $res = ['code'=>1, 'msg'=>'登录成功', 'data'=>['info'=>$info->toArray()]];
                } else {
                    $res = ['code'=>0, 'msg'=>'登录失败', 'data'=>['code'=>0, 'msg'=>'该账号已被禁用']];
                }
            } else {
                $res = ['code'=>0, 'msg'=>'登录失败', 'data'=>['code'=>0, 'msg'=>'密码错误']];
            }
        } else {
            $res = ['code'=>0, 'msg'=>'登录失败', 'data'=>['code'=>0, 'msg'=>'账号不存在']];
        }
        return $res;
    }
/**
 * 登录成功后更新
 * @param  int $id
 * @param  int $loginTimes 登录次数
 * @param  int $ip         ip2long 转换后的整形无符号
 * @return int
 */
    private function _loginUpdate($id, $loginTimes, $ip)
    {
        $update = [
            'last_login_time' => date('Y-m-d H:i:s'),
            'last_login_ip'   => $ip,
            'login_times'     => ++ $loginTimes
        ];
        return $this->save($update, ['id'=>$id]);
    }

    /**
     * 获取管理员名字
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getUser($id)
    {
        return $this->where('id',$id)->value('user');
    }

    /**
     * 根据id获取管理员详情
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getAdminDetail($id)
    {
        return $this->where('id',$id)->find()->toArray();
    }   
}