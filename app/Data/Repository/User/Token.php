<?php


namespace App\Data\Repository\User;

use App\Data\Models\PersonalAccessToken;
use App\Data\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Sanctum\NewAccessToken;

/**
 * Interface Token
 * @package App\Data\Repository\User
 */
interface Token
{
    /**
     * @param User $user
     */
    public function tokens(User $user): MorphMany;

    /**
     * @param User $user
     * @param string $device
     * @return NewAccessToken
     */
    public function createToken(User $user, string $device): NewAccessToken;

    /**
     * @param MorphMany $tokens
     * @return bool|null
     */
    public function delete(MorphMany $tokens): bool|null;
}
