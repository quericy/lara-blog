<?php
/**
 * Repository契约接口
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

}