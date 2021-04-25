<?php

namespace Tests\Unit\Domains\User\Jobs;

use App\Models\User;
use Tests\TestCase;
use App\Domains\User\Jobs\GetUserJob;

class GetUserJobTest extends TestCase
{
    /**
     * @retrun void
     */
    public function test_get_user_job(): void
    {
        $user = User::factory()->create();

        $job = new GetUserJob($user->email);

        $result = $job->handle();

        $this->assertEquals(User::class, get_class($result));
        $this->assertEquals($user->email, $result->email);
    }
}
