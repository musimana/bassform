<?php

namespace App\Http\Resources\Models;

use App\Interfaces\Resources\Readonlys\NavbarReadonlyInterface;
use App\Models\Navbar;

class NavbarModelResource implements NavbarReadonlyInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Navbar $navbar = new Navbar
    ) {
    }

    /** Get the content array for an applicant user. */
    public function getItem(): Navbar
    {
        return $this->navbar;
    }
}
