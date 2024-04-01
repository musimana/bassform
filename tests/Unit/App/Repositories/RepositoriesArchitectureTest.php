<?php

arch('app/Repositories has valid architecture')
    ->expect('App\Repositories')
    ->toBeClasses()
    ->toBeFinal()
    ->toHaveSuffix('Repository')
    ->toOnlyBeUsedIn('App\Http\Controllers');
