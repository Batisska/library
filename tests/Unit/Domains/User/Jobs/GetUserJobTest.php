<?php

namespace Tests\Unit\Domains\User\Jobs;

use App\Data\Models\User;
use App\Data\Repository\User\ReadUser;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Domains\User\Jobs\GetUserJob;

class GetUserJobTest extends TestCase
{
    /**
     * @retrun void
     */
    public function test_get_user_job(): void
    {
        $user = User::factory()->make();

        $job = new GetUserJob($user->email);

        $stub = $this->createMock(ReadUser::class);

        $stub->method('firstOrFail')
             ->willReturn($user);

        $result = $job->handle($stub);

        $this->assertEquals(User::class, get_class($result));
        $this->assertEquals($user->email, $result['email']);
    }
}
