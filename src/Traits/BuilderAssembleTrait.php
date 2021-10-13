<?php

/**
 * (c) linshaowl <linshaowl@163.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lswl\Database\Traits;

use Illuminate\Database\Eloquent\Builder;
use Lswl\Database\Contracts\DatabaseInterface;

/**
 * 查询构造组装辅助
 */
trait BuilderAssembleTrait
{
    /**
     * 组装排序
     * @param Builder $builder
     * @param array $params
     * @param array $fillable
     */
    private static function assembleOrder(Builder $builder, array $params, array $fillable)
    {
        // 排序字段
        if (!empty($params['sort']) && in_array($params['sort'], $fillable)) {
            $direction = DatabaseInterface::DEFAULT_DIRECTION;

            // 排序方式
            if (!empty($params['order']) && in_array($params['order'], ['asc', 'desc'])) {
                $direction = $params['order'];
            }

            // 排序
            $builder->orderBy($params['sort'], $direction);
        }
    }

    /**
     * 组装limit分页
     * @param Builder $builder
     * @param array $params
     */
    private static function assembleLimit(Builder $builder, array $params)
    {
        if (
            (!empty($params['limit']) || !empty($params['offset']))
            && empty($params['page']) && empty($params['page_size'])
        ) {
            // 判断参数
            if (empty($params['offset']) || !is_numeric($params['offset'])) {
                $params['offset'] = DatabaseInterface::DEFAULT_OFFSET;
            }
            if (empty($params['limit']) || !is_numeric($params['limit'])) {
                $params['limit'] = DatabaseInterface::DEFAULT_LIMIT;
            }

            // 分页
            $builder->offset(intval($params['offset']))->limit(intval($params['limit']));
        }
    }

    /**
     * 组装page分页
     * @param Builder $builder
     * @param array $params
     */
    private static function assemblePage(Builder $builder, array $params)
    {
        if (
            empty($params['limit']) && empty($params['offset'])
            && (!empty($params['page']) || !empty($params['page_size']))
        ) {
            // 判断参数
            if (empty($params['page']) || !is_numeric($params['page'])) {
                $params['page'] = DatabaseInterface::DEFAULT_PAGE;
            }
            if (empty($params['page_size']) || !is_numeric($params['page_size'])) {
                $params['page_size'] = DatabaseInterface::DEFAULT_PAGE_SIZE;
            }

            // 分页
            $builder->forPage(intval($params['page']), intval($params['page_size']));
        }
    }
}
