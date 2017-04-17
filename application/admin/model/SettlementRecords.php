<?php  
namespace app\admin\model;

use think\Db;

class SettlementRecords extends Base
{

    /**
     * 根据ID查找会员信息
     * @return [type] [description]
     */
    public function findMember($id){
        return Db::name('member')->where('id',$id)->find();
    }

    /**
     * 根据ID跟新会员金币数量
     * @param  [type] $id   [description]
     * @param  [type] $coin [description]
     * @return [type]       [description]
     */
    public function updataMemberCoin($id,$coin){
        return Db::name('member')->where('id',$id)->update(['coin_num'=>$coin]);
    }

    /**
     * 手动结算
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function settle($data)
    {   
        $this->startTrans();
        try{
            $member1 = self::findMember($data['member_id1']);
            $member2 = self::findMember($data['member_id2']);
            $member3 = self::findMember($data['member_id3']);
            $member4 = self::findMember($data['member_id4']);
            if($member1['coin_num']< abs($data['mi1_money'])){
                return ['code'=>0,'msg'=>'会员1金币不足'];
            }
            if($member2['coin_num']< abs($data['mi2_money'])){
                return ['code'=>0,'msg'=>'会员2金币不足'];
            }
            if($member3['coin_num']< abs($data['mi3_money'])){
                return ['code'=>0,'msg'=>'会员3金币不足'];
            }
            if($member4['coin_num']< abs($data['mi4_money'])){
                return ['code'=>0,'msg'=>'会员4金币不足'];
            }
            $coin1 = $member1['coin_num']+$data['mi1_money'];
            $coin2 = $member2['coin_num']+$data['mi2_money'];
            $coin3 = $member3['coin_num']+$data['mi3_money'];
            $coin4 = $member4['coin_num']+$data['mi4_money'];
            $res1 = self::updataMemberCoin($data['member_id1'],$coin1);
            $res2 = self::updataMemberCoin($data['member_id2'],$coin2);
            $res3 = self::updataMemberCoin($data['member_id3'],$coin3);
            $res4 = self::updataMemberCoin($data['member_id4'],$coin4);
            if($res1 && $res2 && $res3 && $res4){
                $res = $this->save(['status'=>1],['id'=>$data['id']]);
                if($res){
                    $this->commit();
                    return ['code'=>1,'msg'=>'结算成功'];
                }else{
                    return ['code'=>0,'msg'=>'结算失败'];
                }   
            }else{
                    return ['code'=>0,'msg'=>'结算失败'];
            }
        }catch(\Exception $e){
            $this->rollback();
             return error($e->getMessage());
        }
    }



}