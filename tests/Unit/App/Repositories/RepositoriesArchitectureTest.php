<?php

arch('app/Repositories has valid architecture')
    ->expect('App\Repositories')
    ->toBeClasses()
    ->toHaveSuffix('Repository')
    ->toBeUsedIn('App');