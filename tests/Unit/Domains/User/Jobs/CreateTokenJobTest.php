<?php

namespace Tests\Unit\Domains\User\Jobs;

use App\Data\Models\User;
use Laravel\Sanctum\NewAccessToken;
use Tests\TestCase;
use App\Domains\User\Jobs\CreateTokenJob;

class CreateTokenJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_create_token_job(): void
    {
        $user = User::factory()->create();
        $job = new CreateTokenJob($user, 'api_client');

        $token = $job->handle();

        $this->assertEquals(get_class($token),NewAccessToken::class);
    }
}
