<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\User\Jobs;

use App\Data\Models\PersonalAccessToken;
use App\Data\Models\User;
use App\Data\Repository\User\Token;
use App\Data\Repository\User\TokenRepository;
use App\Domains\User\Jobs\CreateTokenJob;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use Tests\TestCase;

class CreateTokenJobTest extends TestCase
{
    /**
     * @return void
     */
    public function test_create_token_job(): void
    {
        $personalToken = PersonalAccessToken::factory()->count(2)->make();

        $user = User::factory()->make();

        $user->setRelation('tokens', $personalToken);

        $job = new CreateTokenJob($user, 'api_client');

        $stub = $this->createMock(Token::class);

        $stub->method('tokens')->willReturn($user->tokens());


        $newPersonalToken = PersonalAccessToken::factory()->make();

        $plainTextToken = $newPersonalToken->getKey() . '|' . Str::random(40);

        $newPersonalToken = new NewAccessToken($newPersonalToken, $plainTextToken);

        $stub->method('createToken')->willReturn($newPersonalToken);

        $token = $job->handle($stub);

        $this->assertEquals(NewAccessToken::class, get_class($token));
    }
}
