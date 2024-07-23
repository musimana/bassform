<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Project Owner Address
    |--------------------------------------------------------------------------
    |
    | The contact details for the project owner.
    |
    */

    'owner' => [
        'address' => env('CONTACT_OWNER_EMAIL', 'admin@example.com'),
        'name' => env('CONTACT_OWNER_NAME', 'superadmin'),
    ],

];
