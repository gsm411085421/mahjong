<?php
namespace app\admin\controller;
use think\Loader;
use think\Db;
use app\admin\modeldata\AuthRule;

class Admin extends Base
{
    protected $header = '权限管理';
    /**
     * 管理员列表 
     * @return view
     */
    public function adminLists()
    {
        $this->view->desc = '管理员列表';
        return $this->fetch('adminLists', ['data'=>parent::model()->getAll()]);
    }
    /**
     * 编辑用户
     * @return view
     */
    public function createUser()
    {
        $id = $this->request->param('id');
        if ($id) { // 编辑用户
            $desc = '编辑用户';
            $detail = parent::model()->getOne($id);
        } else { // 新增用户
            $desc = '添加用户';
            $detail = [];
        }
        $this->view->desc = $desc;
        return $this->fetch('createUser', [
            'groupLists' => $this->_queryAuthGroup('id,title'),
            'detail'     => $detail
            ]);
    }
    /**
     * 编辑用户 表单提交
     */
    public function addUser()
    {
        return parent::model()->editUser($this->request->post());
    }
    /**
     * 用户组列表
     * @return view
     */
    public function groupLists()
    {
        $this->view->desc = '用户组列表';
        $data = $this->_queryAuthGroup();
        return $this->fetch('groupLists', ['data'=>$data]);
    }
/**
 * 用户组详情
 * @return view 
 */
    public function createUserGroup()
    {
        $id = $this->request->param('id');
        if ($id) { // 编辑用户
            $desc = '编辑用户组';
            $detail = Db::name('AuthGroup')->field(true)->find($id);
            $detail['rules'] = explode(',', $detail['rules']);
        } else { // 新增用户
            $desc = '添加用户组';
            $detail = [];
        }
        $this->view->desc = $desc;
        return $this->fetch('createUserGroup', [
            'id'     => $id,
            'rules'  => AuthRule::all(),
            'detail' => $detail
            ]);
    }
    /**
     * 编辑用户组 数据库操作
     * @return integer
     */
    public function editUserGroup()
    {
        $input  = $this->request->post();
        $id     = isset($input['id'])&&$input['id'] ? $input['id'] : false;
        $title  = trim($input['title']);
        // title 验证
        $titleLength = mb_strlen($title);
        if ($titleLength < 2 || $titleLength > 10) {
            return ['code'=>0, 'msg'=>'用户组名称在 2 到 10 个字之间'];
        }
        $titleExist = Db::name('AuthGroup')->where('title', $title)->value('id');
        if ($titleExist) {
            return ['code'=>0, 'msg'=>'用户组名称已存在'];
        }
        $rule   = implode(',', $input['rule']);
        $status = isset($input['status']) ? $input['status'] : 0;

        $insertData = ['title'=>$title, 'status'=>$status, 'rules'=>$rule];
        if ($id) {// 更新
            $handle = Db::name('AuthGroup')->where('id', $id)->update($insertData);
        } else {// 新增
            $handle = Db::name('AuthGroup')->insert($insertData);
        }
        return $handle !== false ? ['code'=>1, 'msg'=>'操作成功'] : ['code'=>0, 'msg'=>'操作失败'];
    }
    /**
     * 设置用户状态
     * @return json
     */
    public function setUserStatus()
    {
        $input  = $this->request->post();
        $id     = $input['id'];
        $status = $input['status'];
        if (1 == $id) {
            $res = ['code'=>0, 'msg'=>'超级管理员不能被禁用'];
        } else {
            $handle = parent::model()->setStatus($status, ['id'=>$id]);
            $res = $handle ? ['code'=>1, 'msg'=>'操作成功'] : ['code'=>0, 'msg'=>'操作失败'];
        }
        return $res;
    }
    /**
     * 删除用户
     * @return json
     */
    public function userDelete()
    {
        $id = $this->request->post('id');
        if (1 == $id) {
            $res = ['code'=>0, 'msg'=>'超级管理员不能删除'];
        } else {
            $handle = parent::model()->setDelete($id);
            $res = $handle ? ['code'=>1, 'msg'=>'操作成功'] : ['code'=>0, 'msg'=>'操作失败'];
        }
        return $res;
    }
    /**
     * 设置用户组状态
     * @return json
     */
    public function setUserGroupStatus()
    {
        $input  = $this->request->post();
        $id     = $input['id'];
        $status = $input['status'];

        $handle = Db::name('AuthGroup')->where('id', $id)->update(['status'=>$status]);
        $res = $handle ? ['code'=>1, 'msg'=>'操作成功'] : ['code'=>0, 'msg'=>'操作失败'];
        return $res;
    }
    /**
     * 删除用户组
     * @return [type] [description]
     */
    public function userGroupDelete()
    {
        $id = $this->request->post('id');
        $occupied = Db::name('AuthGroupAccess')->where('group_id', $id)->field('uid')->find();
        if ($occupied) {
            $info = ['code'=>0, 'msg'=>'当前用户组被占用，不可被删除'];
        } else {
            $delete = Db::name('AuthGroup')->where('id', $id)->delete();
            $info = $delete ? ['code'=>1, 'msg'=>'删除成功'] : ['code'=>0, 'msg'=>'删除失败'];
        }
        return $info;
    }

    /**
     * 导入规则
     * @param  string $token 口令
     */
    public function importRule($token)
    {
        if (65536 == $token) {
            AuthRule::run();
        }
    }
    /**
     * 数据库查询 用户组
     * @return array
     */
    private function _queryAuthGroup($field=true)
    {
        return Db::name('AuthGroup')->field($field)->order('id')->select();
    }
}