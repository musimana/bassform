<?php

use Illuminate\Database\Eloquent\Factories\Factory;

arch('database/factories has valid architecture')
    ->expect('Database\Factories')
    ->toBeClasses()
    ->toExtend(Factory::class)
    ->toHaveSuffix('Factory')
    ->not->toBeUsed()
    ->tohaveMethod('definition');
