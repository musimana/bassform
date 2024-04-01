<?php

use Illuminate\Database\Eloquent\Factories\Factory;

arch('database/factories has valid architecture')
    ->expect('Database\Factories')
    ->toBeClasses()
    ->toBeFinal()
    ->toExtend(Factory::class)
    ->toHaveSuffix('Factory')
    ->not->toBeUsed()
    ->tohaveMethod('definition');
