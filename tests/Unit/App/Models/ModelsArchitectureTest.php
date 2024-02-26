<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

arch('app/Models has valid architecture')
    ->expect('App\Models')
    ->toBeClasses()
    ->toExtend(Model::class)
    ->toUse([
        HasFactory::class,
        SoftDeletes::class,
    ])
    ->not->toHaveSuffix('Model')
    ->toBeUsedIn('App');

arch('app/Models doesn\'t use HTTP classes')
    ->expect(['Illuminate\Http', 'App\Http'])
    ->not->toBeUsedIn('App\Models')
    ->expect('request')
    ->not->toBeUsedIn('App\Models');
