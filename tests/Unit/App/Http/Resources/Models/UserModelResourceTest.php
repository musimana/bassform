<?php

use App\Http\Requests\Auth\ProfileStoreRequest;
use App\Http\Resources\Models\UserModelResource;
use App\Interfaces\Resources\Storables\UserStorableInterface;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(UserModelResource::class)
    ->toImplement(UserStorableInterface::class);

arch('it has a getItem method')
    ->expect(UserModelResource::class)
    ->toHaveMethod('getItem');

arch('it has a storeItem method')
    ->expect(UserModelResource::class)
    ->toHaveMethod('storeItem');

test('getItem returns ok with valid inputs', function (User $user) {
    expect(User::count())->toBe(0);

    $actual = (new UserModelResource($user))->getItem();

    expect($actual)
        ->toBeInstanceOf(User::class)
        ->id->toEqual($user->id)
        ->name->toEqual($user->name)
        ->email->toEqual($user->email)
        ->email_verified_at->toBeInstanceOf(Carbon::class)->not->toBeEmpty()
        ->password->toEqual($user->password)
        ->remember_token->toEqual($user->remember_token)
        ->created_at->toEqual(null)
        ->updated_at->toEqual(null);

    expect(User::count())->toBe(0);
})->with('users');

test('storeItem validates requests with a form request')
    ->assertActionUsesFormRequest(
        UserModelResource::class,
        'storeItem',
        ProfileStoreRequest::class
    );

test('storeItem returns ok with valid inputs', function (User $user) {
    expect(User::count())->toBe(0);

    $request = new ProfileStoreRequest([
        'name' => $user->name,
        'email' => $user->email,
        'password' => config('tests.default_password'),
    ]);

    $user->name = 'Wrong Name';
    $actual = (new UserModelResource($user))->storeItem($request);

    expect($actual)
        ->toBeInstanceOf(User::class)
        ->id->toBeString()
        ->name->not->toEqual('Wrong Name')
        ->email->toEqual($user->email)
        ->email_verified_at->toEqual(null)
        ->remember_token->toEqual(null)
        ->created_at->toBeInstanceOf(Carbon::class)->not->toBeEmpty()
        ->updated_at->toBeInstanceOf(Carbon::class)->not->toBeEmpty();

    $this->assertTrue(Hash::check(config('tests.default_password'), $actual->password));

    expect(User::count())->toBe(1);
})->with('users');
