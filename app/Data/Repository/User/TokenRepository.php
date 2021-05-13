<?php


namespace App\Data\Repository\User;

use App\Data\Models\User;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Class TokenRepository
 * @package App\Data\Repository\User
 */
class TokenRepository implements Token
{
    /**
     * @param User $user
     * @return mixed
     */
    public function tokens(User $user): PersonalAccessToken
    {
        return $user->tokens();
    }

    public function createToken(User $user, string $device): NewAccessToken
    {
       return $user->createToken($device);
    }

    /**
     * @param PersonalAccessToken $token
     * @return bool|null
     */
    public function delete(PersonalAccessToken $token): bool|null
    {
        return $token->delete();
    }
}
