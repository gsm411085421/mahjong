<?php
namespace app\index\model;

class MemberProfile extends Base
{
    protected $rule = [
        'member_id|用户ID'          => 'require',
        'name|真实姓名'             => 'require|max:15',
        'phone|电话号码'            => 'require|regex:^1(3[0-9]|4[57]|5[0-35-9]|7[01678]|8[0-9])\d{8}$',
        'id_cards|身份证号'         => 'max:18',
        'wechat|微信号'             => 'max:32',
        'bank_name|开户银行'        => 'max:32',
        'bank_account|银行卡账号'   => 'max:20',
        'qq|QQ号'                   => 'max:11',
        'email|邮箱'                => 'email',
        'alipay|支付宝账号'         => 'max:50',
        'self_intro|个人介绍'       => 'max:255',
        'panda_id|熊猫麻将ID'       => 'max:8',
        'landlords_id|闲来斗地主ID' => 'max:8'
    ];

    protected $message = [
        'phone.regex' => '电话号码格式错误',
    ];

    /**
     * 根据uid查找一条
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    public function findOne($uid)
    {
        $handle = $this->where('member_id',$uid)->find();
        return $handle ? success('',$handle['id']) : error() ;
    }

    
}