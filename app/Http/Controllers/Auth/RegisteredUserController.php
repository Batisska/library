<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Features\UserRegistrationFeature;
use Illuminate\Http\JsonResponse;
use Lucid\Units\Controller;

class RegisteredUserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        return $this->serve(UserRegistrationFeature::class);
    }
}
