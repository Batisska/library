<?php

declare(strict_types=1);

namespace App\Data\Repository\User;

use App\Data\Models\PersonalAccessToken;
use App\Data\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Sanctum\NewAccessToken;

/**
 * Class TokenRepository
 * @package App\Data\Repository\User
 */
class TokenRepository implements Token
{
    /**
     * @param User $user
     * @return MorphMany
     */
    public function tokens(User $user): MorphMany
    {
        return $user->tokens();
    }

    public function createToken(User $user, string $device): NewAccessToken
    {
        return $user->createToken($device);
    }

    /**
     * @param MorphMany $tokens
     * @return bool|null
     */
    public function delete(MorphMany $tokens): bool | null
    {
        return $tokens->delete();
    }
}
