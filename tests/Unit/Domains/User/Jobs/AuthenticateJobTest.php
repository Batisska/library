<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\User\Jobs;

use App\Domains\User\Jobs\AuthenticateJob;
use App\Data\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
        $user = User::factory()->make();

        $mockRequest = FormRequest::create(route('login'), 'GET', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        Auth::shouldReceive('attempt')
            ->once()
            ->andReturn(true);

        $job = new AuthenticateJob($mockRequest);

        $isValid = $job->handle();

        $this->assertTrue($isValid);
    }
}
