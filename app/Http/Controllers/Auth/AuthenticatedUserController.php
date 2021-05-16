<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Features\UserAuthenticationFeature;
use Illuminate\Http\JsonResponse;
use Lucid\Units\Controller;

class AuthenticatedUserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        return $this->serve(UserAuthenticationFeature::class);
    }
}
