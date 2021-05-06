<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Lucid\Units\Job;

class CreateTokenJob extends Job
{
    /**
     * @var User
     */
    private User $user;

    /**
     * @var string
     */
    private string $device;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param string $device
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
        /** @var PersonalAccessToken $tokens */
        $tokens = $this->user->tokens();
        $tokens->delete();
        return $this->user->createToken($this->device);
    }
}
