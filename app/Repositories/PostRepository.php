<?php
/**
 * Post Repository
 * Date: 2016/11/14 0014
 * Time: 15:17
 */

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends IRepository
{
    /**
     * 模型实例
     * @var \App\Models\Post
     */
    protected $model;

    /**
     * 获取仓库对应模型名称
     */
    public function model()
    {
        return Post::class;
    }


    /**
     * 文章分页
     * @param int $limit
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit = 5, $columns = ['*'])
    {
        //查询文章并分页
        //$posts = Post::where('updated_at', '<=', Carbon::now())
        $posts = $this->model->where('status', 0)
            ->orderBy('id', 'desc')
            ->paginate($limit, $columns);
        //懒惰渴求式加载
        $posts->load([
            'category' => function ($query) {
                $query->where('status', 0);
            },
            'tags' => function ($query) {
                $query->where('status', 0);
            },
        ]);
        return $posts;
    }

    /**
     * 根据字段查找一篇文章
     * @param $field
     * @param $value
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function findOneByField($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->firstOrFail($columns);
    }

}