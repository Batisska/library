<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
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
     * @return User
     */
    public function handle(): User
    {
        return User::where('email',$this->email)->firstOrFail();
    }
}
