<?php
/**
 * worker 助手类
 */

namespace app\worker\server;

use think\Loader;
use app\worker\server\Connection;

use Exception;
use think\Log;

class Helper
{
    public static function parseUrl($json, $connection)
    {
        $arr = json_decode($json, true);
        if (is_array($arr) && !empty($arr)) {
            if (isset($arr['uid']) && $uid = $arr['uid']) {
                // 存储连接
                Connection::getInstance()->add($uid, $connection);

                if (isset($arr['url'])) {
                    try{
                        $param = isset($arr['param'])&&!empty($arr['param']) ? $arr['param'] : [];
                        Loader::action($arr['url'], $param);
                    } catch (Exception $error) {
                        Log::init([
                            'type' => 'File',
                            'path' => ROOT_PATH.'runtime'.DS.'worker'.DS,
                        ]);
                        Log::write('[Worker Error] '.$error->getMessage());
                    }
                }
            }
        }
        return false;
    }
}