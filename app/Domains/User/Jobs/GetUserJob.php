<?php

namespace App\Domains\User\Jobs;

use App\Models\User;
use Lucid\Units\Job;

class GetUserJob extends Job
{
    protected string $email;

    /**
     * Create a new job instance.
     *
     * @return void
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
