<?php  
namespace app\index\model;

use app\index\model\Member;
use app\common\api\SystemConfig;

class Convert extends Base
{   
    /**
     * 获取兑换记录
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    public function getConvert($uid)
    {
        return  $this->where('member_id',$uid)->select();
    } 

    /**
     * 添加兑换记录
     * @param  [type] $uid  [description]
     * @param  [type] $coin [description]
     * @return [type]       [description]
     */
    public function exchange($uid,$coin)
    {   
        $member = new Member();
        $memberInfo = $member->getOne($uid);
        if( $memberInfo['coin_num'] < $coin ){
            $res = error('用户金币不足');
        }else{
            $this->startTrans();
            try{
                //写兑换
                $this->save(['is_agency'=>$memberInfo['is_rank'],'member_id'=>$uid,'convert_num'=>$coin]);
                //用户扣金币
                $res = $member->setCoin($uid, $coin);
                $this->commit();
                $res = success(['convert'=>$this->toArray()]);
            }catch(\Exception $e){
                $this->rollback();
                $res = error($e->getMessage());
            }
        }
        return $res;
    }

    /**
     * 检查兑换条件
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    public function checkConvert($uid,$coin)
    {
        $handle = $this->where('member_id',$uid)->whereTime('create_at','today')->count();
        $systemConfig = new SystemConfig();
        $data = $systemConfig->data();
        if( $handle >= $data['convert1'] ){
            $handle = ['code'=>0,'msg'=>'今日兑换次数已达上线'];
        }else{
            $handle = $this->where('member_id',$uid)->whereTime('create_at','today')->sum('convert_num');     
            if( $data['convert2'] >= $coin ){
                $handle = ['code'=>1,'msg'=>'可以兑换'];
            }
        }
        return $handle;
    }

}