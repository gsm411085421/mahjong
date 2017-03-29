<?php

use think\Collection;

if (!function_exists('success')) {

    /**
     * 响应数组封装
     * @param  string|array $msg  消息 或 数据
     * @param  array  $data 数据
     * @return array ['code'=>1, 'msg'=>'请求成功', 'data'=>[]]
     */
    function success($msg = '', $data = []) {
        if ($msg === '') {
            $msg = '请求成功';
        } elseif (is_array($msg)) {
            $data = $msg;
            $msg = '请求成功';
        }
        return ['code'=>1, 'msg'=>$msg, 'data'=>$data];
    }
}

if (!function_exists('error')) {

    /**
     * 响应数组封装
     * @param  string|array $msg  消息或数据
     * @param  array  $data 数据
     * @return array       ['code'=>0, 'msg'=>'操作失败', 'data'=>[]]
     */
    function error($msg = '', $data = []) {
        if ($msg === '') {
            $msg = '操作失败';
        } elseif (is_array($msg)) {
            $data = $msg;
            $msg = '操作失败';
        }
        return ['code'=>0, 'msg'=>$msg, 'data'=>$data];
    }
}

if (!function_exists('to_array')) {

    /**
     * 数据库 select 结果集转数组 
     * @param  array $data 
     * @return array
     */
    function to_array($data) {
        return Collection::make($data)->toArray();
    }
}

if (!function_exists('to_json')) {

    /**
     * 数据库 select 结果集转 json
     * @param  array $data 
     * @return object       Json
     */
    function to_json($data) {
        return Collection::make($data)->toJson();
    }
}