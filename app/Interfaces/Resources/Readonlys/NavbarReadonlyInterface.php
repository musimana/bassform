<?php

namespace App\Interfaces\Resources\Readonlys;

use App\Models\Navbar;

interface NavbarReadonlyInterface
{
    /** Get the navbar model. */
    public function getItem(): Navbar;
}
