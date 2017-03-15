<?php
/**
 * 系统配置文件
 *
 * @method public update(array $input) 更新文件
 * @method public getData() 获取文件数据 
 */
namespace app\common\api;

class SystemConfig
{
    // 文件名
    protected $file = 'system_config.json';
    // 文件路径
    protected $path;

    private $_data = [];

    public function __construct($file=null)
    {
        $this->path = ROOT_PATH. 'public'. DS. 'data'. DS. 'config'. DS;
        $this->_read();
        if ($file) $this->file = $file;
    }
/**
 * 更新文件
 * @param  array  $input 配置项
 * @return [type]        [description]
 */
    public function update(array $input)
    {
        $this->_data = array_merge($this->_data, $input);
        return $this->_write();
    }
/**
 * 取数据 
 * @return [type] [description]
 */
    public function data()
    {
        return $this->_data;
    }
/**
 * 写文件
 * @return [type] [description]
 */
    private function _write()
    {
        $data = json_encode($this->_data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        return file_put_contents($this->path. $this->file, $data);
    }
/**
 * 读文件
 * @return [type] [description]
 */
    private function _read()
    {
        if (file_exists($this->path. $this->file)) {
            $data = file_get_contents($this->path. $this->file);
            $this->_data = json_decode($data, true);
        }
    }
}