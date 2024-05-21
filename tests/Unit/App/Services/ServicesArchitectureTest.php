<?php

arch('app/Services has valid architecture')
    ->expect('App\Services')
    ->toBeClasses()
    ->toBeFinal()
    ->toHaveSuffix('Service')
    ->toBeUsedIn('App');

arch('app/Services/Admin has valid architecture')
    ->expect('App\Services\Admin')
    ->toHaveSuffix('AdminService');
