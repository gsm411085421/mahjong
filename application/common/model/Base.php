<?php
namespace app\common\model;

use think\Model;
use think\Request;
use think\Validate;
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
    const PAGE_SIZE = 20;

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
    /**
     * 验证规则
     * @var array
     */
    protected $rule;

    protected $message = [];

    protected function initialize()
    {
        parent::initialize();
        
        $this->request = Request::instance();
    }

/**
 * post 请求中的数据
 * @return array
 */
    protected function requestPost($name = '')
    {
        return $this->request->post($name);
    }
/**
 * get 请求中的数据
 * @return array
 */
    protected function requestGet($name = '')
    {
        return $this->request->get($name);
    }
/**
 * 根据主键查询一条
 * @param  string $id 主键值
 * @return Model     数据库对象
 */
    public function getOne($id, $field=true)
    {
        return $this->field($field)->where($this->pk, $id)->find();
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
    public function edit(array $input = [])
    {
        $input = $input ? : $this->requestPost();
        $check = 0;
        if ($this->rule) {
            $check = Validate::make($this->rule, $this->message)->check($input);

            if (false === $check) {
                return ['code'=>0, 'msg'=>Validate::make()->getError()];
            }
        }
        if (($this->rule && $check) || ! $this->rule) {
            $isUpdate = isset($input)&&$input[$this->pk] ? true : false;
            $handle = $this->allowField(true)->isUpdate($isUpdate)->save($input);
            $res = $handle ? ['code'=>1, 'msg'=>'操作成功', 'data'=>['id'=>$this->id]] : ['code'=>0, 'msg'=>'操作失败'];
        }
        return $res;
    }
/**
 * 新增一条数据 
 * @param  array $input 表单数据 
 * @return array  std
 */
    public function addOne(array $input)
    {
        $handle = $this->allowField(true)->isUpdate(false)->save($input);
        return $handle? ['code'=>1, 'msg'=>'添加成功', 'data'=>['id'=>$this->id]] : ['code'=>0, 'msg'=>'添加失败'];
    }
/**
 * 更新一条数据 
 * @param  array  $input 表单数据 
 * @return array        std
 */
    public function updateOne(array $input)
    {
        $handle = $this->allowField(true)->isUpdate(true)->save($input);
        return $handle? ['code'=>1, 'msg'=>'添加成功', 'data'=>['id'=>$this->id]] : ['code'=>0, 'msg'=>'添加失败'];
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
        $handle = $this->where($this->pk, $id)->where($extra)->delete();
        return $handle? ['code'=>1, 'msg'=>'删除成功'] : ['code'=>0, 'msg'=>'删除失败'];
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
    
/**
 * paginate 分页查询
 * @param  array   $where
 * @param  boolean $field
 * @param  int  $pageSize 
 * @return Collection
 */
    public function getLists($where=[], $field=true, $pageSize=null)
    {
        $pageSize === null and $pageSize = self::PAGE_SIZE;
        return $this->where($where)->field(true)->paginate($pageSize);
    }

/**
 * limit 分页查询
 * @param  integer $page     页码
 * @param  array   $where
 * @param  boolean $field
 * @param  int  $pageSize
 * @return array
 */
    public function getListsByLimit($page=1, $where=[], $field=true, $pageSize=null)
    {
        $pageSize === null and $pageSize = self::PAGE_SIZE;
        return $this->where($where)->field($field)->limit($pageSize)->page($page)->select();
    }

    /**
     * 分页并且根据时间排序
     * @param  array  $where    [description]
     * @param  [type] $pageSize [description]
     * @param  array  $config   [description]
     * @return [type]           [description]
     */
    public function getPaginateByTime(array $where , $pageSize ,array $config)
    {
        return $this->where($where)->order('create_at desc')->paginate($pageSize,false,$config);
    }

}
    

