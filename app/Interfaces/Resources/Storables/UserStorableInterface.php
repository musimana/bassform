<?php

namespace App\Interfaces\Resources\Storables;

use App\Http\Requests\Auth\ProfileStoreRequest;
use App\Models\User;

interface UserStorableInterface
{
    /** Get the user model. */
    public function getItem(): User;

    /** Store & return a user model from the given array. */
    public function storeItem(ProfileStoreRequest $request): User;
}
