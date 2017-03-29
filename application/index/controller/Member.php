<?php  
namespace app\index\controller;

use think\Loader;

class Member extends Base
{   

    /**
     * 根据用户ID显示用户信息
     * @return [type] [description]
     */
    public function showMember()
    {    
        $member = Loader::model('Member')->findOne(100001);
        $memberInfo = Loader::model('MemberProfile')->findOne($member['id']);
        $memberGameRecords = Loader::model('MemberGameRecords')->findOne($member['id']);
    }

}