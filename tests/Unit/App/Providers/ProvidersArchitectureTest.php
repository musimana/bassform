<?php

arch('app/Providers has valid architecture')
    ->expect('App\Providers')
    ->toBeClasses()
    ->toBeFinal()
    ->toHaveSuffix('Provider')
    ->toBeUsedIn('App');
