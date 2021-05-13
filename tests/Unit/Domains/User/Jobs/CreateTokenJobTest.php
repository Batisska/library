<?php

namespace Tests\Unit\Domains\User\Jobs;

use App\Data\Models\User;
use App\Data\Repository\User\Token;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;
use Tests\TestCase;
use App\Domains\User\Jobs\CreateTokenJob;

class CreateTokenJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_create_token_job(): void
    {
        $user = User::factory()->make();
        $test = PersonalAccessToken::factory()->make();
        dd($test);
        dd($user->createToken('api_client'));
        $job = new CreateTokenJob($user, 'api_client');

        $stub = $this->createMock(Token::class);

        $stub->method('tokens')
             ->willReturn($author);

        $token = $job->handle();

        $this->assertEquals(get_class($token),NewAccessToken::class);
    }
}
