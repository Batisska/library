<?php


namespace App\Data\Repository\Author;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface WriteModel
 * @package App\Data\Repository
 */
interface WriteAuthor
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
     * @param Model $model
     * @param string $relation
     * @param array $ids
     * @return Model
     */
    public function attach(Model $model, string $relation, array $ids): Model;

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;
}
