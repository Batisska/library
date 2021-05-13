<?php


namespace App\Data\Repository;

use App\Data\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

/**
 * Class BookRepository
 * @package App\Data\Repository
 */
class BookRepository implements BookRepositoryInterface
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
}
