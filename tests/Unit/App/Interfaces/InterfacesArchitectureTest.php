<?php

arch('app/Interfaces has valid architecture')
    ->expect('App\Interfaces')
    ->toBeInterfaces()
    ->toBeUsedIn('App');
