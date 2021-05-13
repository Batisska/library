<?php


namespace App\Data\Repository\Author;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ReadAuthor
 * @package App\Data\Repository\Author
 */
interface ReadAuthor
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
}
