<?php

arch('app/Services has valid architecture')
    ->expect('App\Services')
    ->toBeClasses()
    ->toBeFinal()
    ->toHaveSuffix('Service')
    ->toBeUsedIn('App');
