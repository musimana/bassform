<?php

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;

arch('app/Http has valid architecture')
    ->expect('App\Http')
    ->toBeClasses();

arch('app/Http/Controllers has valid architecture')
    ->expect('App\Http\Controllers')
    ->toExtend(Controller::class)
    ->toHaveSuffix('Controller')
    ->not->toBeUsed()
    ->ignoring(Controller::class);

arch('app/Http/Middleware has valid architecture')
    ->expect('App\Http\Middleware')
    ->toBeUsedIn('App\Http');

arch('app/Http/Requests has valid architecture')
    ->expect('App\Http\Requests')
    ->toExtend(FormRequest::class)
    ->toHaveSuffix('Request')
    ->toBeUsedIn('App\Http\Controllers');

arch('app/Http/Resources has valid architecture')
    ->expect('App\Http\Resources')
    ->toBeClasses()
    ->toHaveSuffix('Resource');

arch('app/Http/Resources/Files has valid architecture')
    ->expect('App\Http\Resources\Files')
    ->toHaveSuffix('FileResource');

arch('app/Http/Resources/Models has valid architecture')
    ->expect('App\Http\Resources\Models')
    ->toBeUsedIn('App')
    ->toHaveSuffix('ModelResource');
