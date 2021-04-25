<?php

namespace App\Features;

use App\Domains\User\Jobs\AuthenticateJob;
use App\Domains\User\Jobs\CreateTokenJob;
use App\Domains\User\Jobs\GetUserJob;
use App\Domains\User\Requests\Login;
use Illuminate\Http\JsonResponse;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class UserAuthenticationFeature extends Feature
{
    /**
     * @param Login $request
     * @return JsonResponse
     */
    public function handle(Login $request): JsonResponse
    {
        $this->run(AuthenticateJob::class, [
           'request' => $request
        ]);

        $user = $this->run(GetUserJob::class, [
           'email' => $request->input('email')
        ]);

        $token = $this->run(CreateTokenJob::class, [
            'user' => $user,
            'device' => 'api_client'
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => [
                'token' => $token->plainTextToken,
                'user' => $user,
            ]
        ]);
    }
}
