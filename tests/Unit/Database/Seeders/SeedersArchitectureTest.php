<?php

use Illuminate\Database\Seeder;

arch('database/seeders has valid architecture')
    ->expect('Database\Seeders')
    ->toBeClasses()
    ->toBeFinal()
    ->toExtend(Seeder::class)
    ->toHaveSuffix('Seeder')
    ->not->toBeUsed()
    ->toHaveMethod('run');
