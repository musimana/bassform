<?php

use App\Http\Resources\Files\LocalDiskFileResource;
use App\Interfaces\Resources\Storables\StringsToStringStorableInterface;

arch('it implements the expected interface')
    ->expect(LocalDiskFileResource::class)
    ->toImplement(StringsToStringStorableInterface::class);

arch('it has a getValue method')
    ->expect(LocalDiskFileResource::class)
    ->toHaveMethod('getValue');

arch('it has a storeValue method')
    ->expect(LocalDiskFileResource::class)
    ->toHaveMethod('storeValue');
