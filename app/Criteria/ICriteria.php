<?php
/**
 * 标准模式基类
 */

namespace App\Criteria;

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class ICriteria
{

    /**
     * @param Model $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public abstract function apply($model, RepositoryInterface $repository);

}