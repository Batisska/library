<?php

declare(strict_types=1);

namespace App\Data\Repository\User;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface ReadUser
 * @package App\Data\Repository\Book
 */
interface ReadUser
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * @param string $column
     * @param string $value
     * @param string $operator
     * @return mixed
     */
    public function firstOrFail(string $column, string $value, string $operator = '='): mixed;
}
