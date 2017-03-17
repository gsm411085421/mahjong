<<<<<<< HEAD
<?php  
=======
<?php 
>>>>>>> ddbfb20ef26c4d9e65402f54d15160f4f128ac3b
namespace app\admin\model;

class Cash extends Base
{
<<<<<<< HEAD
    public function showRecharge($page = 4)
    {
        return $this->field(true)->where('type',1)->paginate($page);
=======
    /**
     * 充值或提现记录列表
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public function getCashs($type)
    {
        return self::getLists(['type'=>$type],true,$pageSize=7);
>>>>>>> ddbfb20ef26c4d9e65402f54d15160f4f128ac3b
    }
}