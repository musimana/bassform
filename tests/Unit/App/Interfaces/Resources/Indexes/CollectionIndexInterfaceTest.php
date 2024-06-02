<?php

use App\Interfaces\Resources\Indexes\CollectionIndexInterface;

arch('it has a getItems method')
    ->expect(CollectionIndexInterface::class)
    ->toHaveMethod('getItems');
