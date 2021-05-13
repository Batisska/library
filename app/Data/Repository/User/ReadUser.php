<?php


namespace App\Data\Repository\User;

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
}
