<?php

arch('app/Enums has valid architecture')
    ->expect('App\Enums')
    ->toBeEnums()
    ->not->toHaveSuffix('Enum')
    ->toBeUsedIn('App');

test('app/Enums/Webpages has valid architecture')
    ->expect('App\Enums\Webpages')
    ->toHavePrefix('Webpage');
