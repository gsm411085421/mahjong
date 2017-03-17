<<<<<<< HEAD
<?php  
namespace app\admin\controller;

=======
<?php 
namespace app\admin\controller;
>>>>>>> ddbfb20ef26c4d9e65402f54d15160f4f128ac3b
use think\Loader;

class Cash extends Base
{
<<<<<<< HEAD
    public function recharge()
    {   
        $data = Loader::model('Cash')->showRecharge();
        return $this->fetch('',[
            'list'=>$data,
            ]);
=======

    protected $header = '会员中心';
    /**
     * 充值或提现列表
     * @return [type] [description]
     */
    public function cashList($type)
    {
      if($type) {
          $file = 'recharge'; $desc = '充值记录列表';
      } else {
          $file = 'withdraw'; $desc = '提现记录列表';
      }
      $file .= 'List';
      $this->view->desc = $desc;
      $data = Loader::model('Cash')->getCashs($type);
      return $this->fetch($file,['data'=>$data]);
    }
    /**
     * 处理状态
     * @return [type] [description]
     */
    public function changeStatus()
    {
        if($this->request->isPost()) {
            $input= $this->request->post();
            $res = Loader::model('Cash')->setStatus($input['status'],['id'=>$input['id']]);
        }
>>>>>>> ddbfb20ef26c4d9e65402f54d15160f4f128ac3b
    }
}