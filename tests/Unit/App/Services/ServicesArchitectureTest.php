<?php

use App\Services\Challenges\ChallengeService;

arch('app/Services has valid architecture')
    ->expect('App\Services')
    ->toBeClasses()
    ->toHaveSuffix('Service')
    ->toBeUsedIn('App');

arch('app/Services/Challenges abstract class has valid architecture')
    ->expect(ChallengeService::class)
    ->not->toBeAbstract();

arch('app/Services/Challenges/Maps has valid architecture')
    ->expect('App\Services\Challenges\Maps')
    ->toHavePrefix('Map');

arch('app/Services/Challenges/Year2023 has valid architecture')
    ->expect('App\Services\Challenges\Year2023')
    ->toExtend(ChallengeService::class)
    ->toHavePrefix('Part');
