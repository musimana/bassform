<?php

arch('app/Services has valid architecture')
    ->expect('App\Services')
    ->toBeClasses()
    ->toHaveSuffix('Service')
    ->toBeUsedIn('App');
