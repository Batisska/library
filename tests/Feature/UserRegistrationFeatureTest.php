<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserRegistrationFeatureTest extends TestCase
{
    public function test_user_registration_feature()
    {
        $data = User::factory()->make();

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
