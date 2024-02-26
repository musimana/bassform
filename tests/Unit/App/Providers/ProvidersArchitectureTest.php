<?php

arch('app/Providers has valid architecture')
    ->expect('App\Providers')
    ->toBeClasses()
    ->toHaveSuffix('Provider')
    ->toBeUsedIn('App');
