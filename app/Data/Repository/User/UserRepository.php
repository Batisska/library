<?php

declare(strict_types=1);

namespace App\Data\Repository\User;

use App\Data\Models\User;

/**
 * Class UserRepository
 * @package App\Data\Repository\User
 */
class UserRepository implements ReadUser, WriteUser
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return User::find($id);
    }

    /**
     * @param string $column
     * @param string $value
     * @param string $operator
     * @return mixed
     */
    public function firstOrFail(string $column, string $value, string $operator = '='): mixed
    {
        return User::where($column, $operator, $value)->firstOrFail();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return (bool)User::destroy($id);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        return (bool)User::where('id', $id)->update($attributes);
    }

    /**
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes): User
    {
        return User::create($attributes);
    }
}
