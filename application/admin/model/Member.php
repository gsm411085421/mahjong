<?php  
namespace app\admin\model;

use think\Db;
use think\Session;

class Member extends Base
{

    /**
     * 更新剩余金币数量并写入充值或者惩罚记录表
     * @return [type] [description]
     */
    public function updateCoin(array $input)
    {   
        $user = Db::name('admin')->where('id',Session::get('uid'))->find(); 
        $input['user'] = $user['user'];
        $coin = $this->where('id',$input['id'])->value('coin_num');
        if( $input['type'] == 'add' ){
            $data = ['member_id'=>$input['id'],'recharge_num'=>$input['coin_num'],'admin_user'=>$input['user']];
            Db::name('Recharge')->insert($data);
            $coin =  $coin + $input['coin_num'];
        }else{
            if($coin<$input['coin_num']){
                 return ['code'=>0,'msg'=>'余额不足'];
            }
            $data = ['member_id'=>$input['id'],'punish_coin'=>$input['coin_num'],'admin_user'=>$input['user']];
            Db::name('PunishCoin')->insert($data);
            $coin =  $coin - $input['coin_num'];
        }
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

    /**
     * 查找上级
     * @param  [type] $pid [description]
     * @return [type]      [description]
     */
    public function showParent($pid)
    {
        return $this->where('id',$pid)->find();
    }

    /**
     * 修改会员状态并存入对应惩罚表
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function changeStatus($data)
    {
        if($data['status']==0){
            $res = $this->isUpdate(true)->save($data);
            if($res){
                $user = Db::name('admin')->where('id',Session::get('uid'))->find();
                $input = ['member_id'=>$data['id'],'seal_user'=>$user['user']];
                $res = Db::name('DisableMember')->insert($input);
                if($res){
                    $handle = ['code'=>1,'msg'=>'修改成功'];
                }else{
                    $handle = ['code'=>0,'msg'=>'修改失败'];
                }
            }else{
                $handle = ['code'=>0,'msg'=>'修改失败'];
            } 
        }else{
            $res = $this->isUpdate(true)->save($data);
            if($res){
                $handle = ['code'=>1,'msg'=>'修改成功'];
            }else{
                $handle = ['code'=>0,'msg'=>'修改失败'];
            }
        }
        return $handle;
    }

}