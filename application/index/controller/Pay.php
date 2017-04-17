<?php
/**
 * 支付接口类
 *
 * 红包支付
 *
 * @link https://pay.weixin.qq.com/wiki/doc/api/tools/cash_coupon.php?chapter=13_4&index=3
 * @link https://easywechat.org/zh-cn/docs/lucky-money.html
 */

namespace app\index\controller;

use EasyWeChat\Foundation\Application;

class Pay extends Base
{
    /**
     * 用户兑换
     * @return [type] [description]
     */
    public function userPay()
    {
        $app = new Application(parent::getWechatConfig());
        $luckyMoney = $app->lucky_money;

        $luckyMoneyData = [
            'mch_billno'       => 'xy123456',
            'send_name'        => '测试红包',
            're_openid'        => 'oxTWIuGaIt6gTKsQRLau2M0yL16E',
            'total_num'        => 1,  //固定为1，可不传
            'total_amount'     => 100,  //单位为分，不小于100
            'wishing'          => '祝福语',
            'client_ip'        => '192.168.0.1',  //可不传，不传则由 SDK 取当前客户端 IP
            'act_name'         => '测试活动',
            'remark'           => '测试备注',
            // ...
        ];
        return $luckyMoney->sendNormal($luckyMoneyData);
    }

    /**
     * 代理提现
     * @return [type] [description]
     */
    public function agentPay()
    {
        $app = new Application(parent::getWechatConfig());
        $luckyMoney = $app->lucky_money;

        $luckyMoneyData = [
            'mch_billno'       => 'xy123456',
            'send_name'        => '测试红包',
            're_openid'        => 'oxTWIuGaIt6gTKsQRLau2M0yL16E',
            'total_num'        => 1,  //固定为1，可不传
            'total_amount'     => 100,  //单位为分，不小于100
            'wishing'          => '祝福语',
            'client_ip'        => '192.168.0.1',  //可不传，不传则由 SDK 取当前客户端 IP
            'act_name'         => '测试活动',
            'remark'           => '测试备注',
            // ...
        ];
        return $luckyMoney->sendNormal($luckyMoneyData);
    }
}