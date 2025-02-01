<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Laravel\Sanctum\Contracts\HasAbilities;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken implements HasAbilities
{
    protected $connection = 'mongodb'; // Specify MongoDB connection
    protected $collection = 'personal_access_tokens'; // Optional: Set collection name

    /**
     * Get the token's abilities.
     *
     * @return array
     */
    public function getAbilities(): array
    {
        return $this->abilities ?? [];
    }

    /**
     * Determine if the token has a given ability.
     *
     * @param  string  $ability
     * @return bool
     */
    public function can($ability): bool
    {
        return in_array('*', $this->getAbilities()) || in_array($ability, $this->getAbilities());
    }

    /**
     * Determine if the token is missing a given ability.
     *
     * @param  string  $ability
     * @return bool
     */
    public function cant($ability): bool
    {
        return !$this->can($ability);
    }
}
