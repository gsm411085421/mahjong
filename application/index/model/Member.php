<?php
namespace app\index\model;

use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class Member extends Base
{
    /**
     * 设置用户元宝数量
     * @param int $id    用户ID
     * @param int $count 增减的数量
     * @param string $type  增|减 inc|dec
     */
    public function setSycee($id, $count, $type = 'dec')
    {
        return $this->_setSyceeCoin($id, 'sycee_num', $type, $count);
    }

    /**
     * 设置用户金币数量
     * @param int $id    用户ID
     * @param int $count 增减的数量
     * @param string $type  增|减 inc|dec
     */
    public function setCoin($id, $count, $type = 'dec')
    {
        return $this->_setSyceeCoin($id, 'coin_num', $type, $count);
    }

    /**
     * 设置金币、元宝数量
     * @param int $id    用户ID
     * @param string $field 字段 sycee_num, coin_num
     * @param string $type  增加|减少 inc|dec
     * @param int $count 数量
     * @return mixed
     */
    private function _setSyceeCoin($id, $field, $type, $count)
    {   
        if ('inc' == $type) {
            $method = 'setInc';
        } elseif ('dec' == $type) {
            $method = 'setDec';
        } else {
            return false;
        }
        return $this->where('id', $id)->$method($field, $count);
    }

    /**
     * 用户登录写入、更新数据
     * @param  array  $input 
     * @return Model
     */
    public function login(array $input)
    {
        $info = $this->field(true)->where('openid', $input['openid'])->find();
        if (empty($info)) { // 写入数据
            $input['login_ip']  = $this->request->ip(true);
            $input['update_at'] = date('Y-m-d H:i:s', $this->request->time(true));
            $this->allowField(true)->save($input);
            $input['id'] = $this->id;
            $this->storageAvatar($input['id'], $input['headimg']);//头像保存到本地
            $this->generateQrCode($input['id']);//生成二维码
            $info = $input;
        } else { // 更新登录信息
            $avatarUpdate = $input['headimg'] != $info->head_img ? true : false;
            if ($avatarUpdate) { // 头像有更新，存储图像，生成二维码
                $this->storageAvatar($info->id, $input['headimg']);
                $this->generateQrCode($info->id);
            }
            $info->login_ip = $this->request->ip(true);
            $info->update_at = date('Y-m-d H:i:s', $this->request->time(true));
            $info->save();
        }
        return $info;
    }
    /**
     * 生成用户的二维码推广图
     * @param  int $uid 用户ID
     * @return
     */
    public function generateQrCode($uid)
    {
        $root = ROOT_PATH.'public'.DS.'data'.DS.'qrcode'.DS;
        $avatar = ROOT_PATH.'public'.DS.'data'.DS.'avatar'.DS.$uid. '.png'; // 用户头像本地存储
        $url    = \think\Url::build('Index/bind', ['member_id'=>$uid], true, true);
        $file = $root. $uid. '.png';
        $qrcode = new BaconQrCodeGenerator;
        return $qrcode->format('png')->size(500)->margin(0)->merge($avatar, .15)->generate($url, $file);
    }

    /**
     * 绑定上下级关系
     * @param  string $uid 当前用户ID
     * @param  string $pid 上级用户ID
     * @return int
     */
    public function bindMember($uid, $pid)
    {
        $level = $this->where('id', $pid)->value('level');
        return $this->save(['pid'=>$pid, 'level'=>$level+1], ['id'=>$uid, 'pid'=>0]);
    }

    /**
     * 保存用户微信头像到本地
     * @param  int $uid 用户ID
     * @param  string $url 微信 headimg
     * @return void
     */
    public function storageAvatar($uid, $url)
    {
        $root = ROOT_PATH.'public'.DS.'data'.DS.'avatar'.DS;
        $fileName = $root . $uid. '.png';

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch);
        curl_close($ch);
        file_put_contents($fileName, $output);
    }

    /**
     * 获取下级
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    public function getChilds($uid)
    {
        return $this->where('pid',$uid)->select();
    }

    /**
     * 获取下级数量
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    public function getChildsNum($uid)
    {
        return $this->where('pid',$uid)->count();
    }

}