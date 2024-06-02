<?php

use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it has a getItem method')
    ->expect(ConstantItemInterface::class)
    ->toHaveMethod('getItem');
