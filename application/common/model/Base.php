<?php
namespace app\common\model;

use think\Model;
use think\Request;
/**
 * @method Model getOne($id) 查询一条
 * @method Collection getAll(array $where=[]) 查询全部
 * @method integer getCount(array $where=[]) 统计总数
 * @method array edit(array $input) 编辑数据 
 * @method array addOne(array $input) 添加一条
 * @method array updateOne(array $input) 更新一条
 * @method integer setStatus($value, $where) 修改 status 字段的值
 * @method integer deleteOne($id, array $extra=[]) 删除一条数据
 */
class Base extends Model
{
    protected $table = false;
    /**
     * 数据表主键字段
     * @var string
     */
    protected $pk = 'id';

    /**
     * \think\Request 实例
     * @var Object
     */
    protected $request;

    protected function initialize()
    {
        parent::initialize();
        
        $this->request = Request::instance();
    }
/**
 * 根据主键查询一条
 * @param  string $id 主键值
 * @return Model     数据库对象
 */
    public function getOne($id)
    {
        return $this->field(true)->where($this->pk, $id)->find();
    }
/**
 * 全表查询
 * @param array $where 查询条件
 * @return Collection
 */
    public function getAll(array $where=[])
    {
        return $this->field(true)->where($where)->select();
    }
/**
 * count 查询
 * @param  array $where 查询条件
 * @return integer
 */
    public function getCount(array $where=[])
    {
        return $this->where($where)->count();
    }
/**
 * 编辑
 * @param  array  $input 表单数据
 * @return array        std
 */
    public function edit(array $input)
    {
        $isUpdate = isset($input)&&$input[$this->pk] ? true : false;
        $handle = $this->allowField(true)->isUpdate($isUpdate)->save($input);
        if ($handle) {
            return ['code'=>1, 'msg'=>'操作成功', 'data'=>['id'=>$this->id]];
        }else{
            return ['code'=>0, 'msg'=>'操作失败'];
        }
    }
/**
 * 新增一条数据 
 * @param  array $input 表单数据 
 * @return array  std
 */
    public function addOne(array $input)
    {
        $handle = $this->allowField(true)->isUpdate(false)->save($input);
        if ($handle) {
            return ['code'=>1, 'msg'=>'添加成功', 'data'=>['id'=>$this->id]];
        }else{
            return ['code'=>0, 'msg'=>'添加失败'];
        }
    }
/**
 * 更新一条数据 
 * @param  array  $input 表单数据 
 * @return array        std
 */
    public function updateOne(array $input)
    {
        $handle = $this->allowField(true)->isUpdate(true)->save($input);
        if ($handle) {
            return ['code'=>1, 'msg'=>'修改成功', 'data'=>['id'=>$this->id]];
        }else{
            return ['code'=>0, 'msg'=>'修改失败'];
        }
    }
/**
 * 设置状态
 * @param integer $value 状态值
 * @param array  $where 条件
 * @return integer
 */
    public function setStatus($value, array $where)
    {
        return $this->save(['status'=>$value], $where);
    }
/**
 * 删除一条
 * @param  string $id    主键值
 * @param  array $extra 额外条件
 * @return integer        删除的条数
 */
    public function deleteOne($id, array $extra=[])
    {
        return $this->where($this->pk, $id)->where($extra)->delete();
    }

    /**
     * 更新表的处理时间
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function changeUpdate($id)
    {   
        $update = [
            'update_at' => date('Y-m-d H:i:s')
        ];
        return $this->isUpdate(true)->save($update,['id'=>$id]);
    }
    

    /**
 * 分页查询
 * @param  array   $where    条件
 * @param  boolean $field    字段
 * @param  int  $pageSize 分页大小 默认20
 * @param  array $config   分页查询配置
 * @return
 */
    public function getPaginate(array $where=[], $field=true, $pageSize=null, array $config=[])
    {
        $pageSize = $pageSize ?: $this->pageSize;
        return $this->where($where)->field($field)->paginate($pageSize, false, $config);
    }

}