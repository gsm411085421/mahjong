<?php
namespace app\admin\controller;

use app\common\controller\Upload as BaseUpload;

class Upload extends BaseUpload
{
    /**
     * 图片上传
     * @param  string $fieldName 表单字段 name
     * @return json
     */
     public function image($fieldName='file')
    {   
        $info = parent::image($fieldName);
        if ($info) {
            $data = [
                'filename' => $info->getFileName(),
                'savename' => $info->getSaveName()
            ];
            $res = ['code'=>1, 'data'=>config('img_save_url').str_replace('\\', '/', $data['savename'])];
        } else {
            $res = ['code'=>0, 'msg'=>$info->getError() ? : '上传失败了'];
        }
        return $res;
    }
}