<?php  
namespace app\admin\model;

use think\Db;

class Member extends Base
{

    /**
     * 更新剩余金币数量
     * @return [type] [description]
     */
    public function updateCoin(array $input)
    {
        $coin = $this->where('id',$input['id'])->value('coin_num');
        $coin = ($input['type'] == 'add') ? ( $coin + $input['coin_num']) : ( $coin - $input['coin_num']) ;
        $res = $this->save(['coin_num'=>$coin],['id'=>$input['id']]);
        if($res){
            return ['code'=>1,'msg'=>'修改成功'];
        }else{
            return ['code'=>0,'msg'=>'修改失败'];
        }
    }

    /**
     * 查询会员详细信息
     * @return [type] [description]
     */
    public function showInfo($id)
    {
        return Db::name('member_profile')->where('member_id',$id)->find();
    }

    /**
     * 查找下级
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showChild($id)
    {   
        return $this->where('pid',$id)->select();
    }

}