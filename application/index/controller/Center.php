<?php
/**
 * 用户个人中心
 */

namespace app\index\controller;

use think\Session;
use think\Loader;

class Center extends Base
{
    protected $table = 'Member';

    /** @var string 推广二维码存在根路径 */
    protected $QrCodeRoot;
    /** @var string 推广二维码 url 根路径 */
    protected $QrCodeUrlRoot;

    public function _initialize()
    {
        parent::_initialize();

        $this->QrCodeRoot = ROOT_PATH.'public'.DS.'data'.DS.'qrcode'.DS;
        $this->QrCodeUrlRoot = '/data/qrcode/';
    }

    /**
     * 个人中心页面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function index()
    {   
        $userInfo = Session::get('userInfo');
        if($userInfo['is_rank']==1){
            $count = Loader::model('Member')->getChildsNum($this->uid);
            return $this->fetch('agent',['count'=>$count]);
        }else{
            return $this->fetch();
        }     
        
    }


    /**
     * 代理说明
     * @return [type] [description]
     */
    public function agentExplain()
    {
        $data = $this->modelApi->agencyDetail();
        return $this->fetch('',['list'=>$data]);
    }


    /**
     * 个人资料
     * @return View 
     */
    public function profile()
    {
        $detail = [];
        $model = parent::model('MemberProfile');
        if ($this->request->isPost()) {
            $input = $this->request->post();
            $input['member_id'] = $this->uid;
            return $model->edit($input);
        }
        $detail = $model->field(true)->where('member_id', $this->uid)->find();
        return $this->fetch('', [
            'exists' => !empty($detail),
            'detail' => $detail,
        ]);
    }

    /**
     * 个人结算明细 
     * @return [type] [description]
     */
    public function balanceDetail($page = 1)
    {   
        $data = parent::model('Settlement')->getRecords($this->uid, $page);
        if ($this->request->isAjax()) { // ajax 翻页请求
            return $data;
        }
        return $this->fetch('balanceDetail', ['list'=>$data]);
    }

    /**
     * 推广二维码页
     * @return View 
     */
    public function qrCode()
    {
        $QrCodeFile = $this->QrCodeRoot. $this->uid. '.png';
        if (!file_exists($QrCodeFile)) {
            parent::model()->generateQrCode($this->uid);
        }

        $QrCodeImg = $this->QrCodeUrlRoot. $this->uid. '.png';
        return $this->fetch('qrCode', ['qrcode'=>$QrCodeImg]);
    }

    /**
     * 兑换明细
     * @return [type] [description]
     */
    public function exchangeDetail()
    {
        $data = Loader::model('Convert')->getConvert($this->uid);
        return $this->fetch('',['list'=>$data]);
    }

    /**
     * 代理下级列表
     * @return [type] [description]
     */
    public function playerList()
    {   
        $member = Loader::model('Member');
        $data = $member->getChilds($this->uid);
        $count = $member->getChildsNum($this->uid);
        return $this->fetch('',['list'=>$data,'count'=>$count]);
    }

    /**
     * 兑换页面
     * @return [type] [description]
     */
    public function exchange()
    {   

        $data = $this->modelApi->convertDetail();
        return $this->fetch('',['list'=>$data]);
    }

}