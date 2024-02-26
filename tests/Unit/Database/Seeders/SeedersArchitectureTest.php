<?php

use Illuminate\Database\Seeder;

arch('database/seeders has valid architecture')
    ->expect('Database\Seeders')
    ->toBeClasses()
    ->toExtend(Seeder::class)
    ->toHaveSuffix('Seeder')
    ->not->toBeUsed()
    ->toHaveMethod('run');
