<?php

namespace App\Http\Resources\Models;

use App\Http\Requests\Auth\ProfileStoreRequest;
use App\Interfaces\Resources\Storables\UserStorableInterface;
use App\Models\User;

class UserModelResource implements UserStorableInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected User $user = new User
    ) {
    }

    /** Get the content array for an applicant user. */
    public function getItem(): User
    {
        return $this->user;
    }

    /** Store an applicant user array as a new user model. */
    public function storeItem(ProfileStoreRequest $request): User
    {
        $this->user = new User;
        $this->user->fill($request->all());
        $this->user->save();

        return $this->user;
    }
}
