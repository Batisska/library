<?php

namespace App\Domains\User\Jobs;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;
use Lucid\Units\Job;

class CreateTokenJob extends Job
{
    private User $user;
    private string $device;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $device)
    {
        //
        $this->user = $user;
        $this->device = $device;
    }

    /**
     * Execute the job.
     *
     * @return NewAccessToken
     */
    public function handle(): NewAccessToken
    {
        return $this->user->createToken($this->device);
    }
}
