<?php  
namespace app\admin\model;

class AuthRule extends Base
{   
    /**
     * 根据用户的菜单权限id数组查询权限
     * @param  array  $id [description]
     * @return [type]     [description]
     */
    public function menu(array $id)
    {
        $data =  $this->where('id|pid','in',$id)->select();
        $data = collection($data)->toArray();
        return self::_regroupMenu($data);
    }

    /**
     * 组成多为数组  菜单数据
     * @param  [type]  $data [description]
     * @param  integer $pid  [description]
     * @return [type]        [description]
     */
    private function _regroupMenu($data, $pid = 0)
    {
        $arr = [];
        foreach($data as $v){
            if(isset($v['pid'])){
                if($v['pid'] == $pid){
                    $v['children'] = $this->_regroupMenu($data, $v['id']);
                    $arr[] = $v;
                }
            }
        }
        return $arr;
    }

    /**
     * 路径获取器
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getnameAttr($value)
    {
        return  "/adminch.php/".$value.".html";
    }

}