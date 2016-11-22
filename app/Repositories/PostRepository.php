<?php
/**
 * 文章数据仓库
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
    public function simplePaginate($limit = 5, $columns = ['*'])
    {
        //$this->applyCriteria();
        //查询文章并分页
        //$posts = Post::where('updated_at', '<=', Carbon::now())
        $posts = $this->orderBy('id', 'desc')->paginate($limit, $columns);
        $posts = $this->getPostOtherInfo($posts);
        return $posts;

    }

    /**
     * 获取文章的分类和标签信息
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Contracts\Pagination\LengthAwarePaginator $collection
     * @return mixed
     */
    public function getPostOtherInfo($collection)
    {
        //懒惰渴求式加载
        $collection->load([
            'category' => function ($query) {
                $query->where('status', 0);
            },
            'tags' => function ($query) {
                $query->where('status', 0);
            },
        ]);
        return $collection;
    }

}