<?php
/**
 * Post Repository
 * Date: 2016/11/14 0014
 * Time: 15:17
 */

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends Repository
{

    /**
     * 获取仓库对应模型
     * @return \App\Models\Post
     */
    public function model()
    {
        return Post::class;
    }

    /**
     * 获取缓存标记
     * @return string
     */
    public function tag()
    {
        return 'post';
    }
    
    public function test()
    {
        $this->CacheObj()->remember();
    }
    


}