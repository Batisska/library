<?php

namespace Tests\Unit\Domains\User\Jobs;

use App\Data\Models\User;
use Tests\TestCase;
use App\Domains\User\Jobs\SaveUserJob;

class SaveUserJobTest extends TestCase
{
    /**
     * @retrun void
     */
    public function test_save_user_job(): void
    {
        $user = User::factory()->make();

        $job = new SaveUserJob($user->name, $user->email, 'password');

        $result = $job->handle();

        $this->assertEquals(User::class, get_class($result));
        $this->assertEquals($user->email, $result->email);
    }
}
