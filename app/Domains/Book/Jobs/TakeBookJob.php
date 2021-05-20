<?php

namespace App\Domains\Book\Jobs;

use App\Data\Repository\User\ReadUser;
use App\Data\Repository\User\WriteUser;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;

/**
 * Class TakeJob
 * @package App\Domains\Book\Jobs
 */
class TakeBookJob extends Job
{
    /**
     * @var int
     */
    private int $user_id;
    /**
     * @var int
     */
    private int $book_id;
    /**
     * @var string
     */
    private string $return_at;

    /**
     * Create a new job instance.
     *
     * @param int $user_id
     * @param int $book_id
     * @param string $return_at
     */
    public function __construct(int $user_id, int $book_id, string $return_at)
    {
        $this->user_id = $user_id;
        $this->book_id = $book_id;
        $this->return_at = $return_at;
    }

    /**
     * @param WriteUser $writeUser
     * @param ReadUser $readUser
     * @return Model
     */
    public function handle(WriteUser $writeUser, ReadUser $readUser): Model
    {
        $user = $readUser->find($this->user_id);

        return $writeUser->attach($user,'books', [$this->book_id] ,[
            'return_at' => $this->return_at
        ]);
    }
}
