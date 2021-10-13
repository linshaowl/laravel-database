<?php

/**
 * (c) linshaowl <linshaowl@163.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lswl\Database\Contracts;

interface DatabaseInterface
{
    public const DEFAULT_OFFSET = 0;
    public const DEFAULT_LIMIT = 10;
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_PAGE_SIZE = 10;
    public const DEFAULT_DIRECTION = 'asc';
}
