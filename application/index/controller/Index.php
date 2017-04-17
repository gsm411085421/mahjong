<?php
namespace app\index\controller;

class Index extends Base
{
    /**
     * 首页
     * @return View 
     */
    public function index()
    {   
        // 注册用户数
        $registerCount = $this->modelApi->getRegisterCount();
        // 即时公告
        $realTimeNotice = parent::model('Notice')->getRealTimeNotice();
        // 房间使用情况
        $roomCount = $this->modelApi->countRoom();
        //充值微信号
        $weChart = $this->modelApi->weChart();

        // parent::model('Member')->generateQrCode($this->uid);
        return $this->fetch('', [
            'registerCount' => $registerCount,
            'realTimeNotice' => $realTimeNotice,
            'roomCount' => $roomCount,
            'weChart'=>$weChart
        ]);
    }

    /**
     * 扫码登录入口
     * @return redirect
     */
    public function bind()
    {
        $memberId = $this->request->param('member_id');
        parent::model('Member')->bindMember($this->uid, $memberId);
        return redirect(url('Index/index'));
    }

    /**
     * 平台规则
     * @return [type] [description]
     */
    public function rule()
    {
        $rule = parent::model('Notice')->getRule();
        return $this->fetch('',['list'=>$rule]);
    }

    /**
     * 系统公告
     * @return [type] [description]
     */
    public function announcement()
    {
        $data = parent::model('Notice')->getAnnouncement();
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 排行页面
     * @return [type] [description]
     */
    public function seniority()
    {
        return $this->fetch();
    }

    

}
