<?php

namespace Tests\Unit\Domains\User\Jobs;

use App\Domains\User\Jobs\AuthenticateJob;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AuthenticateJobTest extends TestCase
{
    /**
     * @return void
     * @throws ValidationException
     */
    public function test_authenticate_job(): void
    {
        $user = User::factory()->create();

        $mockRequest = FormRequest::create(route('login'), 'GET', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $job = new AuthenticateJob($mockRequest);

        $isValid = $job->handle();

        $this->assertTrue($isValid);
    }
}
