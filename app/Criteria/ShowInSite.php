<?php
/**
 * ShowInSite标准模式
 */

namespace App\Criteria;


use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ShowInSite extends ICriteria
{

    /**
     * 在前台显示的标准模式(不显示隐藏内容)
     * @param Model $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model->where('status', 0);
        return $query;
    }
}