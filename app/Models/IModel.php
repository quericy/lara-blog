<?php
/**
 * Models基类,继承自Pea
 */

namespace App\Models;

use Angejia\Pea\Model;

class IModel extends Model
{
    /**
     * 根据模型策略和全局配置文件,决定是否启用ORM构建器缓存
     * @return bool
     */
    public function needCache()
    {
        return $this->needCache && config('cache.ORM') && !self::$disableReadCache;
    }
}