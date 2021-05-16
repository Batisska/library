<?php

declare(strict_types=1);

namespace App\Data\Repository\User;

use App\Data\Models\User;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Interface WriteUser
 * @package App\Data\Repository\Book
 */
interface WriteUser
{
    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;
}
