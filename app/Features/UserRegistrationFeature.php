<?php

namespace App\Features;

use App\Domains\User\Jobs\CreateTokenJob;
use App\Domains\User\Jobs\SaveUserJob;
use App\Domains\User\Requests\Registration;
use Illuminate\Http\JsonResponse;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class UserRegistrationFeature extends Feature
{
    /**
     * @param Registration $request
     * @return JsonResponse
     */
    public function handle(Registration $request): JsonResponse
    {
       $user = $this->run(SaveUserJob::class, [
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => $request->input('password'),
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
