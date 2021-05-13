<?php


namespace App\Data\Repository;

use App\Data\Models\Book;

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
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int;

    /**
     * @param int $id
     * @param array $attributes
     * @return int
     */
    public function update(int $id, array $attributes): int;

}
