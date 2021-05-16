<?php

declare(strict_types=1);

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use App\Data\Repository\User\ReadUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;

class GetUserJob extends Job
{
    /**
     * @var string
     */
    protected string $email;

    /**
     * Create a new job instance.
     *
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @param ReadUser $user
     * @return Model
     */
    public function handle(ReadUser $user): Model
    {
        return $user->firstOrFail('email', $this->email);
    }
}
