<?php
/**
 * 数据仓库模式基类
 */

namespace App\Repositories;

use App\Contracts\RepositoryCriteriaInterface;
use App\Contracts\RepositoryInterface;
use App\Criteria\ICriteria;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class IRepository implements RepositoryInterface, RepositoryCriteriaInterface
{

    /**
     * App
     * @var Application
     */
    protected $app;

    /**
     * 模型
     * @var Model
     */
    protected $model;

    /**
     * 标准模式集合
     * @var Collection
     */
    protected $criteria;

    /**
     * 跳过标准模式标志
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * 获取模型名称
     * @return mixed
     */
    public abstract function model();

    /**
     * Repository构造函数
     * @param Application $app
     * @param Collection $collection
     */
    public function __construct(Application $app, Collection $collection)
    {
        $this->app = $app;
        $this->criteria = $collection;
        $this->makeModel();
    }

    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    |
    */

    /**
     * 制造Repository对应模型的实例
     * @return Model
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model} is not an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    /**
     * 查询所有记录
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->get($columns);
    }

    /**
     * 分页查询
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 25, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * 新增记录
     * @param array $data
     * @return static
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * 保存一个没有大量赋值的模型
     * @param array $data
     * @return bool
     */
    public function save(array $data)
    {
        foreach ($data as $k => $v) {
            $this->model->$k = $v;
        }
        return $this->model->save();
    }

    /**
     * 更新数据中的一个模型
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return bool|int
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * 删除数据库中的一个模型
     * @param array|int $ids
     * @return int
     */
    public function delete($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * 根据主键查找模型
     * @param array|int $ids
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|null
     */
    public function find($ids, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->find($ids, $columns);
    }

    /**
     * 根据属性查找单个模型
     * @param string $attribute
     * @param mixed $value
     * @param string $operator
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|static|null
     */
    public function findOneBy($attribute, $value, $operator = '=', $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->where($attribute, $operator, $value)->first($columns);
    }

    /**
     * 根据属性查找所有符合的模型集合
     * @param $attribute
     * @param $value
     * @param string $operator
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAllBy($attribute, $value, $operator = '=', $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->where($attribute, $operator, $value)->get($columns);
    }

    /**
     * 根据条件数组查找所有符合的模型集合
     * @param array $where
     * @param array $columns
     * @param bool $or 条件之间关联是'与'还是'或'
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findWhere($where, $columns = ['*'], $or = false)
    {
        $this->applyCriteria();
        $model = $this->model;
        $whereFunction = (!$or) ? 'where' : 'orWhere';
        foreach ($where as $field => $value) {
            if ($value instanceof \Closure) {
                $model = $model->{$whereFunction}($value);
            } elseif (is_array($value)) {
                if (count($value) === 3) {
                    list($field, $operator, $search) = $value;
                    $model = $model->{$whereFunction}($field, $operator, $search);
                } elseif (count($value) === 2) {
                    list($field, $search) = $value;
                    $model = $model->{$whereFunction}($field, '=', $search);
                }
            } else {
                $model = $model->{$whereFunction}($field, '=', $value);
            }
        }
        return $model->get($columns);
    }


    /**
     * 延迟预加载
     * @param array $relations
     * @return $this
     */
    public function load(array $relations)
    {
        $this->model = $this->model->load($relations);
        return $this;
    }

    /**
     * 排序
     * @param $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Criteria
    |--------------------------------------------------------------------------
    |
    */

    /**
     * 重置查询标准
     * @return $this
     */
    public function resetScope()
    {
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * 跳过标准模式
     * @param bool $status 是否跳过
     * @return $this
     */
    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * 获取当前仓库压入的所有的标准模式
     * @return mixed
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * 将指定标准模式应用到模型
     * @param ICriteria $criteria
     * @return $this
     */
    public function getByCriteria(ICriteria $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    /**
     * 将指定标准压入仓库的标准模式集合
     * @param ICriteria $criteria
     * @return $this
     */
    public function pushCriteria(ICriteria $criteria)
    {
        $criteria_index = $this->criteria->search(function ($eachExistCriteria) use ($criteria) {
            return (is_object($eachExistCriteria) && (get_class($eachExistCriteria) === get_class($criteria)));
        });
        //已存在的标准,移除后重新压入
        if (is_int($criteria_index)) {
            $this->criteria->offsetUnset($criteria_index);
        }
        $this->criteria->push($criteria);
        return $this;
    }

    /**
     * 应用仓库中所有设置的标准模式
     * @return $this
     */
    public function applyCriteria()
    {
        if ($this->skipCriteria) {
            return $this;
        }
        foreach ($this->getCriteria() as $eachCriteria) {
            if ($eachCriteria instanceof ICriteria) {
                $this->model = $eachCriteria->apply($this->model, $this);
            }
        }
        return $this;
    }

}