<?php
/**
 * 标准模式契约接口
 */

namespace App\Contracts;


use App\Criteria\ICriteria;

interface RepositoryCriteriaInterface
{
    /**
     * 跳过标准模式
     * @param bool $status 是否跳过
     * @return $this
     */
    public function skipCriteria($status = true);

    /**
     * 获取当前仓库压入的所有的标准模式
     * @return mixed
     */
    public function getCriteria();

    /**
     * 将指定标准模式应用到模型
     * @param ICriteria $criteria
     * @return $this
     */
    public function getByCriteria(ICriteria $criteria);

    /**
     * 将指定标准压入仓库的标准模式集合
     * @param ICriteria $criteria
     * @return $this
     */
    public function pushCriteria(ICriteria $criteria);

    /**
     * 应用仓库中所有设置的标准模式
     * @return $this
     */
    public function applyCriteria();
}