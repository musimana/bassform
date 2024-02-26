<?php

arch('app/Traits has valid architecture')
    ->expect('App\Traits')
    ->toBeTraits()
    ->not->toHaveSuffix('Trait')
    ->toBeUsedIn('App');
