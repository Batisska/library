<?php


namespace App\Data\Repository\Book;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface BookRepositoryInterface
 * @package App\Data\Repository
 */
interface ReadBook
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
