<?php


namespace App\Data\Repository;

use App\Data\Models\Book;
use Illuminate\Database\Eloquent\Collection;

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
     * @return int
     */
    public function destroy(int $id): int
    {
        return Book::destroy($id);
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
}
