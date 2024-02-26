<?php

arch('dumps are not in use')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();
