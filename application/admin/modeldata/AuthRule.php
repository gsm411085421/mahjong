<?php
namespace app\admin\modeldata;

use think\Db;

class AuthRule
{
    const TABLE = 'tp_auth_rule';

    public static $rule = [
        ['name'=>'Admin/adminLists', 'title'=>'查看系统管理员' ],
        ['name'=>'Admin/createUser', 'title'=>'查看管理员详情' ],
        ['name'=>'Admin/addUser', 'title'=>'添加/修改系统管理员' ],
        ['name'=>'Admin/setUserStatus', 'title'=>'设置管理员状态'],
        ['name'=>'Admin/userDelete', 'title'=>'删除管理员'],
        ['name'=>'Admin/groupLists', 'title'=>'查看用户组'],
        ['name'=>'Admin/createUserGroup', 'title'=>'查看用户组详情'],
        ['name'=>'Admin/editUserGroup', 'title'=>'添加/修改用户组'],
        ['name'=>'Admin/setUserGroupStatus', 'title'=>'设置用户组状态'],
        ['name'=>'Admin/userGroupDelete', 'title'=>'删除用户组'],

        // ['name'=>'Article/index', 'title'=>'文章列表'],
        // ['name'=>'Article/trash', 'title'=>'文章回收站'],
        // ['name'=>'Article/create', 'title'=>'发布文章'],
        // ['name'=>'Article/edit', 'title'=>'编辑文章'],
        // ['name'=>'Article/setStatus', 'title'=>'修改文章状态'],
        // ['name'=>'Article/addToTrash', 'title'=>'文章加入回收站'],
        // ['name'=>'Article/restore', 'title'=>'文章恢复'],
        // ['name'=>'Article/delete', 'title'=>'删除文章'],

        // ['name'=>'System/index', 'title'=>'学长等级设置'],
        // ['name'=>'System/indexSubmit', 'title'=>'修改学长等级设置'],
        // ['name'=>'System/config', 'title'=>'业务配置'],
        // ['name'=>'System/integralSubmit', 'title'=>'修改充值积分设置'],
        // ['name'=>'System/submitConfig', 'title'=>'修改业务配置'],
    ];
    /**
     * 导入数据库
     */
    public static function run()
    {
        Db::execute("TRUNCATE TABLE ". self::TABLE);
        Db::table(self::TABLE)->insertAll(self::$rule);
    }
    /**
     * 查询所有数据 
     * @return array
     */
    public static function all()
    {
        return Db::table(self::TABLE)->field(true)->where('pid',0)->select();
    }

}