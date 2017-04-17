<?php  
namespace app\index\controller;

class Convert extends Base
{   
    /**
     * 写兑换记录
     * @return [type] [description]
     */
    public function exchange()
    {   
        if($this->request->isPost()){
            $data = $this->request->post();
            $handle = parent::model()->checkConvert($this->uid,$data['coin_num']);
            if($handle['code']==1){
                return parent::model()->exchange($this->uid,$data['coin_num']);
            }else{
                return $handle;
            }    
        }   
    }

}