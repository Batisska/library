<?php

namespace App\Domains\User\Jobs;

use App\Data\Models\User;
use App\Data\Repository\User\Token;
use App\Data\Repository\User\WriteUser;
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
        $this->user = $user;
        $this->device = $device;
    }

    /**
     * Execute the job.
     *
     * @param Token $token
     * @return NewAccessToken
     */
    public function handle(Token $token): NewAccessToken
    {
        $tokens = $token->tokens($this->user);

        $token->delete($tokens);

        return $token->createToken($this->user,$this->device);
    }
}
