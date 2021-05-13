<?php


namespace App\Data\Repository;

use App\Data\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BookRepository
 * @package App\Data\Repository
 */
class BookRepository implements ReadBook, WriteBook
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return Book::with('authors')->find($id);
    }

    /**
     * @return Collection|array
     */
    public function all(): Collection|array
    {
        return Book::all();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return (bool)Book::destroy($id);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        return (bool)Book::where('id',$id)->update($attributes);
    }

    /**
     * @param string $column
     * @param string $desc
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function paginate(string $column, string $desc, int $limit): LengthAwarePaginator
    {
        return Book::orderBy($column ?? 'id', $desc ?? 'desc')->paginate($limit);
    }

    /**
     * @param array $attributes
     * @return Book
     */
    public function create(array $attributes): Book
    {
        return Book::create($attributes);
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
