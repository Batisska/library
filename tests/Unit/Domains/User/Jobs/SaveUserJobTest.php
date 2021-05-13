<?php

namespace Tests\Unit\Domains\User\Jobs;

use App\Data\Models\User;
use App\Data\Repository\User\ReadUser;
use App\Data\Repository\User\WriteUser;
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

        $stub = $this->createMock(WriteUser::class);

        $stub->method('create')
             ->willReturn($user);

        $result = $job->handle($stub);

        $this->assertEquals(User::class, get_class($result));
        $this->assertEquals($user->email, $result['email']);
    }
}
