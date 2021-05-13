<?php


namespace App\Data\Repository\User;

use App\Data\Models\User;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Interface Token
 * @package App\Data\Repository\User
 */
interface Token
{
    /**
     * @param User $user
     * @return PersonalAccessToken
     */
    public function tokens(User $user): PersonalAccessToken;

    /**
     * @param User $user
     * @param string $device
     * @return NewAccessToken
     */
    public function createToken(User $user, string $device): NewAccessToken;

    /**
     * @param PersonalAccessToken $token
     * @return bool|null
     */
    public function delete(PersonalAccessToken $token): bool|null;
}
