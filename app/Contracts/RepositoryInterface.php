<?php
/**
 * 数据仓库模式契约接口
 * Date: 2016/11/21 0021
 * Time: 16:06
 */

namespace App\Contracts;


interface RepositoryInterface
{

    /**
     * Repository对应模型名称
     */
    public function model();

    /**
     * 制造Repository对应模型的实例
     */
    public function makeModel();

    /**
     * 查询所有记录
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = array('*'));

    /**
     * 分页查询
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 25, $columns = array('*'));

    /**
     * 新增记录
     * @param array $data
     * @return static
     */
    public function create(array $data);

    /**
     * 保存一个没有大量赋值的模型
     * @param array $data
     * @return bool
     */
    public function save(array $data);

    /**
     * 更新数据中的一个模型
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return bool|int
     */
    public function update(array $data, $id, $attribute = "id");

    /**
     * 删除数据库中的一个模型
     * @param array|int $ids
     * @return int
     */
    public function delete($ids);

    /**
     * 根据主键查找模型
     * @param array|int $ids
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|null
     */
    public function find($ids, $columns = array('*'));

    /**
     * 根据属性查找单个模型
     * @param string $attribute
     * @param mixed $value
     * @param string $operator
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|static|null
     */
    public function findOneBy($attribute, $value, $operator = '=', $columns = array('*'));

    /**
     * 根据属性查找所有符合的模型集合
     * @param $attribute
     * @param $value
     * @param string $operator
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAllBy($attribute, $value, $operator = '=', $columns = array('*'));

    /**
     * 根据条件数组查找所有符合的模型集合
     * @param array $where
     * @param array $columns
     * @param bool $or 条件之间关联是'与'还是'或'
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findWhere($where, $columns = ['*'], $or = false);

}