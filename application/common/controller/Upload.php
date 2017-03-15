<?php
/**
 * 上传控制器
 */
namespace app\common\controller;
use think\Request;
class Upload
{
    /**
     * 文件验证规则
     * @var array
     */
    protected $validateRule = [
        'image' => [
            'size' => 5242880, // 5M
            'ext'  => 'jpg,jpeg,png,gif,bmp'
        ],
        'file'  => [
            'size' => 5242880, // 5M
            'ext'  => 'pdf,txt,doc,docx,xls,xlsx'
        ],
    ];
    /**
     * 上传图片
     * @param  string $fieldName 表单字段 name
     * @return mixed
     */
    protected function image($fieldName='')
    {
        $file = Request::instance()->file($fieldName);
        return $file->validate($this->validateRule['image'])
                ->move(ROOT_PATH. 'public'. DS. 'uploads');
    }

    protected function file($fieldName='file'){}
}