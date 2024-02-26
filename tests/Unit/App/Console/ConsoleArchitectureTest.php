<?php

use App\Console\Commands\AppCommand;

arch('app/Console has valid architecture')
    ->expect('App\Console')
    ->toBeClasses();

arch('app/Console/Commands abstract class has valid architecture')
    ->expect(AppCommand::class)
    ->toBeAbstract();

arch('app/Console/Commands has valid architecture')
    ->expect('App\Console\Commands')
    ->toExtend(AppCommand::class)
    ->not->toBeUsed()
    ->ignoring(AppCommand::class);

arch('app/Console/Commands/Seeds has valid architecture')
    ->expect('App\Console\Commands\Seeds')
    ->toHavePrefix('Seed');
