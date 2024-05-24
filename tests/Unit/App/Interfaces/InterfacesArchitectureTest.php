<?php

arch('app/Interfaces has valid architecture')
    ->expect('App\Interfaces')
    ->toBeInterfaces();

arch('app/Interfaces/Requests has valid architecture')
    ->expect('App\Interfaces\Requests')
    ->toHaveSuffix('Interface')
    ->toBeUsedIn('App\Http\Requests')
    ->tohaveMethod('rules');

arch('app/Interfaces/Resources has valid architecture')
    ->expect('App\Interfaces\Resources')
    ->toBeUsedIn('App\Http\Resources');

arch('app/Interfaces/Resources/Formatters has valid architecture')
    ->expect('App\Interfaces\Resources\Formatters')
    ->toHaveSuffix('FormatterInterface')
    ->tohaveMethod('getValue');

arch('app/Interfaces/Resources/Indexes has valid architecture')
    ->expect('App\Interfaces\Resources\Indexes')
    ->toHaveSuffix('IndexInterface')
    ->tohaveMethod('getItems');

arch('app/Interfaces/Resources/Items has valid architecture')
    ->expect('App\Interfaces\Resources\Items')
    ->toHaveSuffix('ItemInterface')
    ->tohaveMethod('getItem');

arch('app/Interfaces/Resources/Storables has valid architecture')
    ->expect('App\Interfaces\Resources\Storables')
    ->toHaveSuffix('StorableInterface');
