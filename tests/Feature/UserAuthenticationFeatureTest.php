<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserAuthenticationFeatureTest extends TestCase
{
    /**
     * @return void
     */
    public function test_user_authentication_feature(): void
    {
        $user = User::factory()->create();

        $this->postJson(route('login'),[
           'email' => $user->email,
           'password' => 'password'
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.user.email', $user->email)
            ->assertJsonPath('data.user.name', $user->name);
    }

    /**
     * @return void
     */
    public function test_get_user_info(): void
    {
       $user = User::factory()->create();

       $this->actingAs($user)->get('/api/user')
       ->assertSuccessful();
    }
}
