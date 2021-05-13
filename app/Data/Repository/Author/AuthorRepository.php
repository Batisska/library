<?php


namespace App\Data\Repository\Author;

use App\Data\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


/**
 * Class AuthorRepository
 * @package App\Data\Repository\Author
 */
class AuthorRepository implements ReadAuthor, WriteAuthor
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return Author::with('books')->find($id);
    }

    /**
     * @return Collection|array
     */
    public function all(): Collection|array
    {
        return Author::all();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return (bool)Author::destroy($id);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        return (bool)Author::where('id',$id)->update($attributes);
    }

    /**
     * @param string $column
     * @param string $desc
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function paginate(string $column, string $desc, int $limit): LengthAwarePaginator
    {
        return Author::orderBy($column ?? 'id', $desc ?? 'desc')->paginate($limit);
    }

    /**
     * @param array $attributes
     * @return Author
     */
    public function create(array $attributes): Author
    {
        return Author::create($attributes);
    }

    /**
     * @param Model $model
     * @param string $relation
     * @param array $ids
     * @return Model
     */
    public function attach(Model $model, string $relation, array $ids): Model
    {
        $model->{$relation}()->attach($ids);

        $model->load($relation);

        return $model;
    }
}
