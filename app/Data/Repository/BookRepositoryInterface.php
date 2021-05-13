<?php


namespace App\Data\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

/**
 * Interface BookRepositoryInterface
 * @package App\Data\Repository
 */
interface BookRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * @return mixed
     */
    public function all(): mixed;

    /**
     * @param string $column
     * @param string $desc
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function paginate(string $column, string $desc, int $limit): LengthAwarePaginator;

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;

}
