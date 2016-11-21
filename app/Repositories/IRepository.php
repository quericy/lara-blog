<?php
/**
 * abstract Repository
 * Date: 2016/11/14 0014
 * Time: 15:18
 */

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

abstract class IRepository implements RepositoryInterface
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Model
     */
    protected $model;


    public abstract function model();

    /**
     * Repository构造函数
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

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

}