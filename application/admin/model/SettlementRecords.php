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


}