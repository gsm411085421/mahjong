<?php
/**
 * 发送手机短信
 * @author lixin_gg@126.com
 * @version 1.0
 * @mktime 2017-1-14
 *
 * 适用接口 凌凯短信平台
 *
 * 内容模板中 __value__  标识可变内容
 *
 */
class PhoneMsg
{

    /** 验证手机号码格式的正则式 */
    const PHONE_REGEX = "#^1(3[0-9]|4[57]|5[0-35-9]|7[01678]|8[0-9])\d{8}$#"; 
    // 日志保存路径
    const LOG_FILE = './phone_msg.xml';

    // 账号
    private $CorpID ;
    // 密码
    private $Pwd    ;
    // 平台 
    private $platform = 'LK';
    // 是否记录日志
    private $writeLog = false;



/** @var 内容模板 [description] */
    protected $msgTemplate = [
        'validateCode'     => '验证码:__value__请在2分钟内按页面提示提交验证码，谢谢！',
 ];
/**
 * 配置账号，密码，平台 
 * @param string $CorpID 账号
 * @param string $Pwd    密码
 * @param string $platform 短信平台 
 */
    public function __construct($CorpID=null, $Pwd=null, $platform=null)
    {
        isset($CorpID) && $this->CorpID = $CorpID;
        isset($Pwd)    && $this->Pwd    = $Pwd;
        isset($platform) && $this->platform = $platform;
    }
/**
 * 开启日志记录
 * @param  boolean $param 是否开启
 * @return $this
 */
    public function writeLogON($param)
    {
        $this->writeLog = $param == true ? true : false;
        return $this;
    }
/**
 * 设置内容模板
 * @param string $key     标识名
 * @param string $content 短信内容 可变内容用 __value__ 替换
 * @return $this
 */
    public function setTemplate($key, $content)
    {
        $this->msgTemplate = array_merge($this->msgTemplate, [$key=>$content]);
        return $this;
    }
/**
 * 发送短信
 * @param  string $phone       手机号
 * @param  string $templateKey 模板标识 或 短信内容
 * @param  mixed $replace      替换内容 false 将 $templateKey 作为内容直接发送
 * @return array
 */
    public function send($phone, $templateKey, $replace=null)
    {
        if(self::validatePhone($phone)){
            if(false !== $replace){
                $content = $this->msgTemplate[$templateKey];
                if(is_array($replace)){
                    $search = [];
                    for($i=0; $i < count($replace); $i++){
                        $search[] = '__value'.$i.'__';
                    }
                    $content = str_replace($search, $replace, $content);
                }elseif($replace){
                    $content = str_replace('__value__', $replace, $content);
                }
            }else{
                $content = $templateKey;
            }
            if($this->_sendMsg($phone, $content)){
                return ['code'=>1, 'msg'=>'短信发送成功'];
            }else{
                return ['code'=>0, 'msg'=>'短信发送失败']
            }
        }else{
            return ['code'=>0, 'msg'=>'手机号格式错误'];
        }
    }

/**
 * 发送手机验证码
 * @param string  $phone 手机号
 * @param integer $length 验证码长度
 * @return array
 */
    public function sendCode($phone, $length = 6)
    {
        $codeMin = intval('1'. '0'*($length-1));
        $codeMax = intval('9'*$length);
        $code = mt_rand($codeMin, $codeMax);
        $action = $this->send($phone, 'validateCode', $code);
        if($action){
            return ['code'=>1, 'msg'=>'发送验证码成功', 'data'=>['code'=>$code]];
        }else{
            return ['code'=>0, 'msg'=>'发送验证码失败'];
        }
    }
/**
 * 正则验证手机号
 * @param  string $phone 手机号
 * @return boolean
 */
    protected static function validatePhone($phone)
    {
        return preg_match(self::PHONE_REGEX, $phone);
    }
/**
 * 接口调用
 * @param  string $phone   手机号
 * @param  string $content 短信内容
 * @return boolean
 */
    private function _sendMsg($phone, $content)
    {
        $url = $this->_buildUrl($phone, $content);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch);
        if($this->writeLog){ // 记录日志
            self::_log($output);
        }
        curl_close($ch);
        if($output>0){
            return true;
        }else{
            return false;
        }
    }

/**
 * 短信平台链接拼接
 * @param  string $phone   接收手机号
 * @param  string $content 接收内容
 * @return string          url
 */
    private function _buildUrl($phone, $content)
    {
        switch($this->platform){
            case 'LK' : $url = "http://yzm.mb345.com/utf8/BatchSend2.aspx?CorpID={$this->CorpID}&Pwd={$this->Pwd}&Mobile={$phone}&Content={$msg}&SendTime=&cell="; break;
            default : $url = '';
        }
        return $url;
    }
/**
 * 记录日志
 * @return true
 */
    private static function _log($xml)
    {
        if(file_exists(self::LOG_FILE) && filesize(self::LOG_FILE)>5*1024*1024){
            file_put_contents(self::LOG_FILE, $xml."\n");
        }else{
            file_put_contents(self::LOG_FILE, $xml."\n", FILE_APPEND);
        }
        return true;
    }
}