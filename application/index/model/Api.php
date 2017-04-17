<?php
namespace app\index\model;

use think\Db;
use app\common\api\SystemConfig;

class Api
{
    /**
     * 获取注册用户数
     * @return [type] [description]
     */
    public function getRegisterCount()
    {   
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        $base = $data['system1'];// 基数，从后台配置中取出
        $count = Db::name('Member')->count();
        return $base + $count;
    }

    /**
     * 统计当前房间使用情况
     * @return array
     */
    public function countRoom()
    {   
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        $data = [
            'm' => ['free'=>$data['system2'], 'playing'=>$data['system3']], // 麻将空闲房间数，游戏中房间数
            'd' => ['free'=>$data['system5'], 'playing'=>$data['system6']]
        ];
        return $data;
    }

    /**
     * 获取充值微信号
     * @return [type] [description]
     */
    public function weChart()
    {
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        return $data['wechart'];
    }

    /**
     * 获取代理说明信息
     * @return [type] [description]
     */
    public function agencyDetail()
    {
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        return $data['agencyDetail'];
    }

    /**
     * 获取兑换配置信息
     * @return [type] [description]
     */
    public function convertDetail()
    {
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        $data = ['convert1'=>$data['convert1'],'convert2'=>$data['convert2']];
        return $data;
    }


}