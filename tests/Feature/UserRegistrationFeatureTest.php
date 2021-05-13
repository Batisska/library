<?php

namespace Tests\Feature;

use App\Data\Models\PersonalAccessToken;
use App\Data\Models\User;
use App\Data\Repository\User\Token;
use App\Data\Repository\User\WriteUser;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class UserRegistrationFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_user_registration_feature(): void
    {
        $data = User::factory()->make();

        $this->instance(WriteUser::class, Mockery::mock(WriteUser::class, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('create')->andReturn($data);
        }));

        $this->instance(Token::class, Mockery::mock(Token::class, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('tokens')->andReturn($data->tokens());
            $mock->shouldReceive('delete')->andReturn(true);

            $newPersonalToken = PersonalAccessToken::factory()->make();
            $plainTextToken = $newPersonalToken->getKey() . '|' . Str::random(40);
            $newPersonalToken = new NewAccessToken($newPersonalToken, $plainTextToken);

            $mock->shouldReceive('createToken')->andReturn($newPersonalToken);
        }));

        $this->postJson(route('register'), [
            'email' => $data->email,
            'name' => $data->name,
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
             ->assertOk()
             ->assertJsonPath('data.user.email', $data->email)
             ->assertJsonPath('data.user.name', $data->name);
    }
}
