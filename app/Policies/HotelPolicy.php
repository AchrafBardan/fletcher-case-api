<?php

namespace App\Policies;

use App\Models\Hotels\Hotel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HotelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hotels\Hotel  $hotel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Hotel $hotel)
    {
        return $hotel->users()->where('users.id', $user->getKey())->exists();
    }
}
