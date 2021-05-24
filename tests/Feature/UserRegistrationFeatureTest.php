<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Data\Models\PersonalAccessToken;
use App\Data\Models\User;
use App\Data\Repository\User\Token;
use App\Data\Repository\User\WriteUser;
use App\Domains\User\Requests\Registration;
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
    public function testUserRegistrationFeature(): void
    {
        $this->withoutExceptionHandling();
        $data = User::factory()->make();



        $this->instance(WriteUser::class, Mockery::mock(WriteUser::class, function (MockInterface $mock) use ($data): void {
            $mock->shouldReceive('create')->andReturn($data);
        }));

        $this->instance(Token::class, Mockery::mock(Token::class, function (MockInterface $mock) use ($data): void {
            $mock->shouldReceive('tokens')->andReturn($data->tokens());
            $mock->shouldReceive('delete')->andReturn(true);

            $newPersonalToken = PersonalAccessToken::factory()->make();
            $plainTextToken = $newPersonalToken->getKey() . '|' . Str::random(40);
            $newPersonalToken = new NewAccessToken($newPersonalToken, $plainTextToken);

            $mock->shouldReceive('createToken')->andReturn($newPersonalToken);
        }));

        $sendData = [
            'email' => $data->email,
            'name' => $data->name,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $request = Registration::create(route('register', $sendData), 'POST');
        $this->instance(Registration::class, $request);

        $this->postJson(route('register'), $sendData)
             ->assertOk()
             ->assertJsonPath('data.user.email', $data->email)
             ->assertJsonPath('data.user.name', $data->name);
    }
}
