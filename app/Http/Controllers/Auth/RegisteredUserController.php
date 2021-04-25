<?php

namespace App\Http\Controllers\Auth;

use App\Features\UserRegistrationFeature;
use Lucid\Units\Controller;

class RegisteredUserController extends Controller
{
    public function store()
    {
        return $this->serve(UserRegistrationFeature::class);
    }
}
